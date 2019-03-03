import 'babel-polyfill'
import React from 'react'
import {render} from 'react-dom'
import {DownloadForm} from "./components/DownloadForm"

function renderAppInElement(el) {

    // get props from elements data attribute, like the post_id
    const props = Object.assign({}, el.dataset);


    render(
        <DownloadForm ref={(df) => {
            if(!window.DownloadForms) window.DownloadForms = [];
            window.DownloadForms.push(df)
        }} {...props} />,
        el
    );
}

function ready(){
    document
        .querySelectorAll('.__react-root')
        .forEach(renderAppInElement);
}

document.addEventListener("DOMContentLoaded", ready);

function setFormFieldValue(elqForm, strFormFieldName, strContactFieldName) {
    if (elqForm.elements[strFormFieldName])
        elqForm.elements[strFormFieldName].value = window.GetElqContentPersonalizationValue(strContactFieldName);
}

window.SetElqContent = function () {
    if (window.GetElqContentPersonalizationValue) {

        const formVals = {
            firstName: window.GetElqContentPersonalizationValue("V_ElqFirstName"),
            lastName: window.GetElqContentPersonalizationValue("V_ElqLastName"),
            company: window.GetElqContentPersonalizationValue("V_ElqCompanyName"),
            title: window.GetElqContentPersonalizationValue("V_ElqJobTitle"),
            emailAddress: window.GetElqContentPersonalizationValue("V_ElqEmailAddress"),
            busPhone: window.GetElqContentPersonalizationValue("V_ElqPhoneNumber"),
        };

        if (window.DownloadForms && window.DownloadForms.constructor === Array) {
            window.DownloadForms.forEach(df => df.loadFormVals(formVals));
        } else {
            window.elqFormVals = formVals;
        }


    }
};














