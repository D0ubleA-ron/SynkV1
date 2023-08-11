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

const topSong = document.querySelector('.top-songs');

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