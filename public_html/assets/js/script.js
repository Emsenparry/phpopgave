let ApiData = [];

fetch ('http://phpopgave.local/api/song/')

.then((response) => {
    return response.json();
})
.then(songs => {
    console.log(songs);
    ApiData = songs
})
.catch((err) => {
    console.error(err);
})
.finally(() => {
    for(let i = 0; i < ApiData.length; i++) {
        let song = ApiData[i];
        createElm(song);
    }
})

const createElm = (song) => {
    document.getElementById('app').innerHTML += `
    <h1>${song.title}</h1>`
}
