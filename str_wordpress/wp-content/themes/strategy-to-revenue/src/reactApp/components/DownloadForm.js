import React, {Component} from 'react';
import posed from 'react-pose';
import PropTypes from 'prop-types';
import {RegisterForm} from "./RegisterForm";
import {apiLogDownload} from "../services/server";

//const pdfUrl = "http://localhost:8888/wp-content/uploads/2018/12/Power-Up-Your-Move-to-Cloud_Dec18.pdf";
const pdfUrl = "http://strategytorevenue.com/webDev/wp-content/uploads/2018/12/Power-Up-Your-Move-to-Cloud_Dec18.pdf";

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
            title: null,
            emailAddress: null,
            busPhone: null,
        }
    }

    handleFirstClick(e) {
        e.preventDefault();
        this.setState({viewState: ViewState.REQUEST});
    }

    handleFormSubmitted(details) {
        apiLogDownload(details).then(() => {
            //Put any validation here
        });
        this.setState({viewState: ViewState.POST_SUBMIT})
    }

    loadFormVals(formVals) {
        this.setState({...formVals})
    }

    renderThumbnailTemplate(imageUrl) {
        const {viewState} = this.state;
        const instruction = viewState === ViewState.PRE_SUBMIT ? "Download our cloud sales transition and improvement guide to setting up a successful cloud sales strategy"
            : "Thank you!";

        const preDownLoadButton = (
            <button className="btn btn-primary btn-sm" onClick={(e) => this.handleFirstClick(e)}>
                Download</button>);

        const postDownLoadButton = (
            <div>
                <br/>
                <a href={this.props.pdfUrl} target="_blank" className="btn btn-primary btn-sm ready">
                    Download PDF Now</a></div>);

        const instructionButton = viewState === ViewState.PRE_SUBMIT ? preDownLoadButton : postDownLoadButton;


        return (<>
            <div className="col-sm-6 d-none d-sm-block">
                <img src={imageUrl} alt=""
                     className="alignnone size-full wp-image-298"/>
            </div>
            <div className="col-12 col-sm-6">


                <div className="download-text">
                    <p>
                        {instruction}
                    </p>
                    <div className="text-center">
                        {instructionButton}
                    </div>
                </div>
            </div>
        </>)
    }

    renderSimpleTemplate() {

        const {viewState} = this.state;
        const preDownLoadButton = (
            <div className="download-button-container">
                <button className="btn btn-secondary btn-lg orange" onClick={(e) => this.handleFirstClick(e)}>
                    Download Now
                </button>
            </div>);

        const postDownLoadButton = (
            <div className="download-button-container">
                <a href={this.props.pdfUrl} target="_blank" className="btn btn-secondary btn-lg orange ready">
                    Download Your PDF</a></div>);

        const instructionButton = viewState === ViewState.PRE_SUBMIT ? preDownLoadButton : postDownLoadButton;


        return (<div className="col-12 text-center">
            {instructionButton}
        </div>)
    }

    renderGartnerTemplate(imageUrl) {

        const {viewState} = this.state;
        const preDownLoadButton = (
            <div className="download-button-container">
                <button className="btn btn-primary btn-lg" onClick={(e) => this.handleFirstClick(e)}>
                    Download Now
                </button>
            </div>);

        const postDownLoadButton = (
            <div className="download-button-container">
                <a href={this.props.pdfUrl} target="_blank" className="btn btn-primary btn-lg ready">
                    Download Your PDF</a></div>);

        const instructionButton = viewState === ViewState.PRE_SUBMIT ? preDownLoadButton : postDownLoadButton;


        return (
            <div className="col-12">
                <h3 className="display-3">Curious about the latest developments in CRM?</h3>
                <p className="accent-large pt-4 pb-3 clr-dark-blue">Download the <span
                    className="clr-bright-blue">Gartner Hype Cycle</span> 2018
                    Report</p>

                {instructionButton}

            </div>
        )

    }

    render() {
        const {viewState} = this.state;

        const regProps = {
            ...this.state,
            formName: this.props.formName,
            formSubmitted: (details) => this.handleFormSubmitted(details)
        };

        let viewOneContent;

        switch (this.props.templateType.toLowerCase()) {
            case 'simple':
                viewOneContent = this.renderSimpleTemplate();
                break;
            case 'gartner':
                viewOneContent = this.renderGartnerTemplate(this.props.imageUrl);
                break;
            default:
                viewOneContent = this.renderThumbnailTemplate(this.props.imageUrl);
                break;

        }

        const registerInstruction = this.props.registerInstruction || "Please register your contact details to download our case study";

        const innerContent = (
            <>

                <DownloadViewOne
                    className="row download-content secondary-screen justify-content-center align-items-center w-100"
                    pose={viewState === ViewState.PRE_SUBMIT || viewState === ViewState.POST_SUBMIT ? 'visible' : 'hidden'}>

                    {viewOneContent}

                </DownloadViewOne>
                <DownloadViewTwo className="row download-content"
                                 pose={viewState === ViewState.REQUEST ? 'visible' : 'hidden'}>
                    <div className="col-12 col-sm-6">
                        <div className="download-text">
                            <p>
                                {registerInstruction}
                            </p>
                            <small>
                                To find out more about how we might use your data please read our <a
                                href="/privacy-notice">Privacy Notice</a>
                            </small>
                            {/*                                <label htmlFor="chkAgree">I agree to share my contact details
                                    <input id="chkAgree" type="checkbox" className="form-control form-control-sm"/>
                                </label>*/}

                        </div>
                    </div>
                    <div className="col-12 col-sm-6">
                        <form className="elq-form" name="str_form_download">
                            <RegisterForm {...regProps} />
                        </form>
                    </div>
                </DownloadViewTwo>

            </>
        );

        if (this.props.templateType === 'simple') {

            let sectionStyle = {};

            if (this.props.imageUrl && this.props.imageUrl.length) {

                sectionStyle = {
                    backgroundPositionX: 'right',
                    backgroundPositionY: 'bottom',
                    backgroundImage: 'url(' + this.props.imageUrl + ')',
                    backgroundSize: 'cover',
                    backgroundRepeat: 'no-repeat'
                };
            }

            const tintClass = viewState === ViewState.REQUEST ? " tint" : "";
            return (
                <section style={sectionStyle} className={"container-fluid sales-leader-guide" + tintClass}>

                    <div className="download-form-container">

                        {innerContent}
                    </div>

                </section>

            );
        } else if (this.props.templateType === 'gartner') {

            const imageStyle = {
                position: 'absolute',
                width: '12rem',
                left: '2rem',
                bottom: '3rem'
            };

            return (
                <section className="container-fluid text-center clr-dark-blue">
                    <img src={this.props.imageUrl} style={imageStyle} />
                    <div className="download-form-container gartner">
                    {innerContent}
                    </div>
                </section>
            )

        } else {
            return (
                <div className="download-form-container">

                    {innerContent}

                </div>
            );
        }


    }

}

DownloadForm.propTypes = {
    pdfUrl: PropTypes.string,
    imageUrl: PropTypes.string,
    formName: PropTypes.string,
    templateType: PropTypes.string,
    registerInstruction: PropTypes.string,
};

DownloadForm.defaultProps = {
    formName: "STRContentOfferingForm",
    registerInstruction: "Please register your contact details to download our case study",
    templateType: "thumbnail"
};