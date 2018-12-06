import 'babel-polyfill'
import React from 'react'
import {render} from 'react-dom'
import {Provider} from 'react-redux'
//import {createStore} from 'redux'
import "./static/css/main.css"
import "./scss/main.scss"
import { DownloadForm } from "./app/components/DownloadForm"

let appEl = document.getElementById('app');
if(appEl){

    render(
        <DownloadForm></DownloadForm>,
        appEl
    );

}













