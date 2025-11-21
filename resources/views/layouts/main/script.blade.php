 {{-- jQuery and Axios (if not already included) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    let currentUserId = null;
    let pollingInterval = null;

    // click user
    $(document).on('click', '.user-item', function(e) {
        e.preventDefault();
        const userId = $(this).data('user-id');
        const name = $(this).find('strong').text().trim();
        setActiveUser($(this));
        openConversation(userId, name);
    });

     function setActiveUser($el) {
        $('.user-item').removeClass('active');
        $el.addClass('active');
    }

    // open conversation
    function openConversation(userId, name) {
        currentUserId = userId;
        $('#chatWith').html('<strong>Chat with: </strong> ' + name);
        $('#messageForm').show();
        $('#chatWindow').html('<div class="text-center text-muted">Loading...</div>');

        fetchConversation();

        // start polling
        if (pollingInterval) clearInterval(pollingInterval);
        pollingInterval = setInterval(fetchConversation, 3000);
    }

    // get prievious massage history
    function fetchConversation() {
        if (!currentUserId) return;

        $.ajax({
            url: `/messages/${currentUserId}`,
            method: "GET",
            dataType: "json",

            success: function(messages) {
                renderMessages(messages);
                refreshConversationList(); // update unseen count & last message
            },

            error: function(xhr, status, error) {
                console.error("Error fetching messages:", error);
            }
        });
    }

    // get messages from database and render this function
     function renderMessages(messages) {
        let html = '';
        messages.forEach(function(m) {
            let time = new Date(m.created_at).toLocaleString();
            if (m.sender_id == {{ auth()->id() }}) {
                html += '<div class="message me" style="background-color:#00cc99"><div>'+ (m.body ? escapeHtml(m.body) : '') + (m.image ? '<div class="mt-2"><a href="/'+m.image+'" target="_blank"><img src="/'+m.image+'" style="max-width:200px;border-radius:8px;"></a></div>' : '') +'<small>'+ time +'</small></div>';
            } else {
                html += '<div class="message other"><div><strong>'+ escapeHtml(m.sender.name) +'</strong><br>'+ (m.body ? escapeHtml(m.body) : '') + (m.image ? '<div class="mt-2"><a href="/'+m.image+'" target="_blank"><img src="/'+m.image+'" style="max-width:200px;border-radius:8px;"></a></div>' : '') +'<small>'+ time +'</small></div></div>';
            }
        });
        $('#chatWindow').html(html);
        // scroll bottom
        $('#chatWindow').scrollTop($('#chatWindow')[0].scrollHeight);
    }


     // send message
    $('#messageForm').on('submit', function(e) {
        e.preventDefault();
        if (!currentUserId) return alert('Select a user first.');

        const formData = new FormData(this);
        $.ajax({
            url: '/messages/' + currentUserId,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(res) {
                $('#body').val('');
                $('#image').val('');
                fetchConversation();
            },
            error: function(xhr) {
                alert('Error sending message.');
            }
        });
    });  

    function escapeHtml(text) {
        if (!text) return '';
        return text.replace(/[&<>"'\/]/g, function(s) {
            return ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
                '/': '&#x2F;'
            })[s];
        });
    }   

    // refresh conversation list (for unseen counts)
    function refreshConversationList() {
        $.ajax({
            url: "/messages/summary",
            method: "GET",
            dataType: "json",

            success: function(list) {
                list.forEach(function(u) {

                    const $item = $('.user-item[data-user-id="' + u.user_id + '"]');

                    if ($item.length) {

                        // update last message preview
                        $item.find('.text-truncate').text(
                            u.last_message ? u.last_message.slice(0, 40) : ''
                        );

                        // remove old badges
                        $item.find('.badge').remove();

                        // add new unseen count
                        if (u.unseen > 0) {
                            $item.find('.d-flex .flex-fill')
                                 .append('<span class="badge bg-danger ms-2">' + u.unseen + '</span>');
                        }
                    }
                });
            },

            error: function(xhr, status, error) {
                console.error("Failed to load conversation list:", error);
            }
        });
    }


    // manual refresh button
    $('#refreshBtn').on('click', function(){ 
        fetchConversation();
         refreshConversationList();
    });

    // initial: optionally open first user
    const $first = $('.user-item').first();
    if ($first.length) {
        $first.trigger('click');
    }
});
</script>