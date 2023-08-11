$(document).ready(function() {
    setInterval(function(){
        $.ajax({
            url: "../retrieve-post.php",
            dataType: "json",
            success: function(data) {
                $("#post-container").empty(); // clear the container before appending new posts
                $.each(data, function(i, post) {
                    $("#post-container").append(
                        '<div class="post">' +
                        '<h2>' + data[i].postTitle + '</h2>' +
                        '<h4>' + data[i].userName + '</h4>' +
                        '<p>' + data[i].postContent + '</p>' +
                        '</div>'
                    );
                });
            }
        });
    }, 1);
});
