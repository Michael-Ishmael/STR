import fetch from "cross-fetch";

//const baseUrl = window.m3_globals && window.m3_globals.apiUrl ? window.m3_globals.apiUrl
//    : "http://localhost/123";
const baseUrl = 'http://localhost:8888/wp-json/str/v1';

export function apiLogDownload(userDetails){

    return fetch(baseUrl + '/download-form',
        {
            method: "POST",
            headers: {
                "Content-Type": "application/json; charset=utf-8",
            },
            body: JSON.stringify( userDetails )
        })
        .then(
            response => response.json(),
            error => console.log('An error occurred: ', error)
        )
}