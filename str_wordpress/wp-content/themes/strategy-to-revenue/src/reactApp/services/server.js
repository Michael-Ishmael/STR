import fetch from "cross-fetch";

//const baseUrl = window.m3_globals && window.m3_globals.apiUrl ? window.m3_globals.apiUrl
//    : "http://localhost/123";
//const baseUrl = 'http://localhost:8888/wp-json/str/v1';
const baseUrl = 'https://strategytorevenue.com/wp-json/str/v1';

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
        ).then(function (data) {

            return eloquaRegister(userDetails);

        })
}

export function eloquaRegister(userDetails) {

    const data = new URLSearchParams();
    Object.keys(userDetails).forEach(key => {
        data.append(key, userDetails[key])
    });

    return fetch("https://s1107488773.t.eloqua.com/e/f2",
        {
            method: "POST",
            body: data
        })
        .then(
            response => response,
            error => console.log('An error occurred: ', error)
        )
}