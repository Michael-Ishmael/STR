import React, {Component} from 'react';
import posed from 'react-pose';
import PropTypes from 'prop-types';
import {RegisterForm} from "./RegisterForm";
import {apiLogDownload} from "../services/server";

const pdfUrl = "http://localhost:8888/wp-content/uploads/2018/12/Power-Up-Your-Move-to-Cloud_Dec18.pdf";

const ViewState = {
    PRE_SUBMIT: "PRE_SUBMIT",
    REQUEST: "REQUEST",
    POST_SUBMIT: "POST_SUBMIT",
};

const DownloadViewOne = posed.div(
    {
        hidden: {

            x: "-100%",
            transition: {
                x: {type: 'spring', stiffness: 100, damping: 15},
                default: {duration: 1}
            },

        },
        visible: {
            x: "0%",
            transition: {
                x: {type: 'spring', stiffness: 100, damping: 15},
                default: {duration: 1}
            },

        },
    }
);

const DownloadViewTwo = posed.div(
    {
        hidden: {
            y: 0,
            x: "100%",
            transition: {
                x: {type: 'spring', stiffness: 100, damping: 15},
                default: {duration: 1}
            }
        },
        visible: {
            y: 0,
            x: "0%",
            transition: {
                x: {type: 'spring', stiffness: 100, damping: 15},
                default: {duration: 1}
            },

        },
    }
);


export class DownloadForm extends Component {

    constructor(props) {
        super(props);
        this.initialiseState();
    }

    initialiseState() {
        this.state = {
            viewState: ViewState.PRE_SUBMIT,
            firstName: null,
            lastName: null,
            company: null,
            jobTitle: null,
            email: null,
            phone: null,
        }
    }

    handleFirstClick(e) {
        e.preventDefault();
        this.setState({viewState: ViewState.REQUEST});
    }

    handleFormSubmitted(details) {
        apiLogDownload(details).then(() => {
            this.setState({viewState: ViewState.POST_SUBMIT})
        });

    }

    handleUserInput(e) {
        const name = e.target.name;
        const value = e.target.value;
        this.setState({[name]: value}, () => this.validateAll());
    }

    validateField(fieldName) {

        const value = this.state[fieldName];
        if (value == null || value.length === 0) {
            return "Required field is missing";
        } else {
            switch (fieldName) {
                case 'country':
                    if (value === 'notSet') {
                        return "Country not selected";
                    }
                    break;
                case 'email':
                    let emailValid = value.match(/^([\w.%+-]+)@([\w-]+\.)+([\w]{2,})$/i);
                    if (!emailValid) return 'Email address is invalid';
                    break;
                case 'password':
                    let passwordValid = value.length >= 6;
                    if (!passwordValid) return 'Password is too short';
                    break;
                case 'confirm':
                    let confirmMatch = value === this.state.password;
                    if (!confirmMatch) return 'Passwords don\'t match';
                    break;
                default:
                    break;
            }
        }
        return null;

    }

    render() {
        const {viewState} = this.state;

        const instruction = viewState === ViewState.PRE_SUBMIT ? "Download our cloud sales transition and improvement guide to setting up a successful cloud sales strategy"
            : "Thank you!";

        const preDownLoadButton = (
            <button className="btn btn-primary btn-sm" onClick={(e) => this.handleFirstClick(e)}>
                Download</button>);

        const postDownLoadButton = (
            <a href={pdfUrl} target="_blank" className="btn btn-primary btn-sm ready">
                Download PDF Now</a>);

        const instructionButton = viewState === ViewState.PRE_SUBMIT ? preDownLoadButton : postDownLoadButton;

        return (
            <div className="download-form-container">


                <DownloadViewOne className="row download-content secondary-screen"
                                 pose={viewState === ViewState.PRE_SUBMIT || viewState === ViewState.POST_SUBMIT ? 'visible' : 'hidden'}>

                    <div className="row download-content"
                         pose={viewState === ViewState.REQUEST ? 'visible' : 'hidden'}>
                        <div className="col-sm-6 d-none d-sm-block">
                            <img src="http://localhost:8888/wp-content/uploads/2018/12/cloud_pdf.jpg" alt=""
                                 className="alignnone size-full wp-image-298"/>
                        </div>
                        <div className="col-12 col-sm-6">


                            <div className="download-text">
                                <p>
                                    {instruction}
                                </p>
                                <p className="text-right">
                                    {instructionButton}
                                </p>
                            </div>
                        </div>

                    </div>

                </DownloadViewOne>
                <DownloadViewTwo className="row download-content"
                                 pose={viewState === ViewState.REQUEST ? 'visible' : 'hidden'}>
                    <div className="col-sm-6 d-none d-sm-block">
                        <div className="download-text">
                            <p>
                                Please register your contact details to download our case study
                            </p>
                            <p className="text-right">
                                <label htmlFor="chkAgree">I agree to share my contact details
                                    <input id="chkAgree" type="checkbox" className="form-control form-control-sm"/>
                                </label>

                            </p>
                        </div>
                    </div>
                    <div className="col-12 col-sm-6">
                        <RegisterForm formSubmitted={(details) => this.handleFormSubmitted(details)}/>
                    </div>
                </DownloadViewTwo>


            </div>
        );

    }

}