const post = [
    {
        title: "Party Playlist!",
        user: "-JimmyNeutron54",
        content: "My party has been hella boring recently guys, help me make it better"
    },
    {
        title: "My wife filed for divorce",
        user: "-ABrokenHeartDude69",
        content: "We have been married for 40 years. Please give me some breakup songs. Mary please come back..."
    },
    {
        title: "YO RAP MUSIC",
        user: "-EASYE",
        content: "GUYS I WANNA BE LIKE EMINEM, HELP YA BOY GET SOME RAP SONGS WORDDDDDDD"
    },
    {
        title: "YO RAP MUSIC",
        user: "-BobTheBuilder",
        content: "GUYS I WANNA BE LIKE EMINEM, HELP YA BOY GET SOME RAP SONGS WORDDDDDDD"
    },
    {
        title: "YO RAP MUSIC",
        user: "-Phineas",
        content: "GUYS I WANNA BE LIKE EMINEM, HELP YA BOY GET SOME RAP SONGS WORDDDDDDD"
    },
    {
        title: "YO RAP MUSIC",
        user: "-MidterMisser123",
        content: "GUYS I WANNA BE LIKE EMINEM, HELP YA BOY GET SOME RAP SONGS WORDDDDDDD"
    },
    {
        title: "YO RAP MUSIC",
        user: "-bruhBruhBrUh",
        content: "GUYS I WANNA BE LIKE EMINEM, HELP YA BOY GET SOME RAP SONGS WORDDDDDDD"
    },
    {
        title: "YO RAP MUSIC",
        user: "-LmaoIranOutOfNames",
        content: "GUYS I WANNA BE LIKE EMINEM, HELP YA BOY GET SOME RAP SONGS WORDDDDDDD"
    },
    {
        title: "YO RAP MUSIC",
        user: "-MetroBoominWantSomeMore",
        content: "GUYS I WANNA BE LIKE EMINEM, HELP YA BOY GET SOME RAP SONGS WORDDDDDDD"
    }
]

const song = [
    {
        title: "DNA",
        image: "https://upload.wikimedia.org/wikipedia/en/5/51/Kendrick_Lamar_-_Damn.png"
    },
    {
        title: "Tangerine",
        image: "https://f4.bcbits.com/img/a0865930574_16.jpg"
    },
    {
        title: "Expensive",
        image: "https://t2.genius.com/unsafe/444x444/https%3A%2F%2Fimages.genius.com%2F8909bc9b2cf49aee040d25321b73e1c0.1000x1000x1.png"
    }
]

const postContainer = document.querySelector('.post-container');
const topSong = document.querySelector('.top-songs');

post.forEach(post => {
    const postElement = document.createElement('div');
    postElement.classList.add('post');
    postElement.innerHTML=`
    <h2>${post.title}</h2>
    <h4>${post.user}</h4>
    <p>${post.content}</p>
    `;

    postContainer.appendChild(postElement);
})
/*
song.forEach(song => {
    const songElement = document.createElement('div');
    songElement.classList.add('song');
    const img = new Image();
    img.src = song.image;
    img.className = 'img-class';
    const figElement = document.createElement('figure');
    figElement.appendChild(img);

    const figCaptionElement = document.createElement('figcaption');
    figCaptionElement.textContent=song.title;
    songElement.appendChild(figElement);
    songElement.appendChild(figCaptionElement);
    topSong.appendChild(songElement);

})
*/



const poster = document.querySelectorAll('.post');

poster.forEach(post2 => {
    post2.addEventListener('onClick', () => {
        const postId = post2.getAttribute('data-post-id');

        window.location.href = `comment.php?id=${postId}`;
    });
});