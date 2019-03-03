import {Component} from "react";
import React from "react";
import {EloquaField} from "./EloquaField"
import PropTypes from "prop-types";


export class RegisterForm extends Component {

    constructor(props) {
        super(props);
        this.initialiseState();
    }

    initialiseState() {
        this.state = {
            firstName: this.props.firstName || "",
            lastName: this.props.lastName || "",
            company: this.props.company || "",
            title: this.props.title || "",
            emailAddress: this.props.emailAddress || "",
            busPhone: this.props.busPhone || "",
            formErrors: {}
        }
    }

    componentWillReceiveProps(nextProps) {
        let newVals = {};
        Object.keys(nextProps).forEach(
            key => {
                if (this.state[key] !== nextProps[key])
                    newVals[key] = nextProps[key];
            });
        this.setState(newVals);
    }


    handleUserInput(e) {
        const name = e.target.name;
        const value = e.target.value;
        this.setState({[name]: value});
    }

    validateField(fieldName) {

        const value = this.state[fieldName];
        if (value == null || value.length === 0) {
            return "Input required";
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

    validateAll(doneFunc) {
        const formErrors = {
            firstName: this.validateField('firstName'),
            lastName: this.validateField('lastName'),
            company: this.validateField('company'),
            title: this.validateField('title'),
            emailAddress: this.validateField('emailAddress'),
            busPhone: this.validateField('busPhone'),
        };
        const errors = Object.keys(formErrors).map(key => formErrors[key]).filter(o => o != null && o.length > 0);
        this.setState({formErrors: formErrors, formValid: errors.length === 0}, () => {
            if (doneFunc) doneFunc();
        })
    }

    submitForm(e) {

/*        this.props.formSubmitted();
        return;*/

        let formValid = true;
        if (e && e.currentTarget && e.currentTarget.form && LiveValidationForm) {
            const lvForm = LiveValidationForm.getInstance(e.currentTarget.form);
            if (lvForm) {
                formValid = !!LiveValidation.massValidate(lvForm.fields);
            }
        }

        if (formValid) {

            const hiddenFields = {
                elqFormName: this.props.formName,
                elqSiteId: "1107488773",
                elqCustomerGUID: window && window.GetElqCustomerGUID === 'function' ? window.GetElqCustomerGUID() : "",
                elqCookieWrite: 1,
                elqCampaignId: "",
                leadSource: "Web",
                conversionPage: window.location.href
            };

            const {firstName, lastName, company, title, emailAddress, busPhone} = this.state;
            const details = {
                ...hiddenFields,
                firstName, lastName, company, title, emailAddress, busPhone
            };
            this.props.formSubmitted(details);
        }

    }

    errorClass(controlType, error) {
        if (this.state.showErrors && (error && error.length > 0 || controlType === 'catchAll')) {
            if (controlType === 'input') return 'is-invalid';
            if (controlType === 'label') return 'text-danger';
            if (controlType === 'catchAll') return 'text-danger';
        }
        return '';
    }


    render() {

        return (
            <>

                <div className="row">
                    <div className="form-group col-6 pr-1">
                        <EloquaField id="field0" name="firstName" value={this.props.firstName} placeholder="First Name"
                                     onChange={(event) => this.handleUserInput(event)}
                                     errorClass={this.errorClass("input", this.state.formErrors.firstName)}/>
                        {/*                        <input type="text"
                               className={`form-control form-control-sm ${this.errorClass("input", this.state.formErrors.firstName)}`}
                               name="firstName" id="firstName"
                               onChange={(event) => this.handleUserInput(event)}
                               placeholder="First Name"/>
                        <small className={this.errorClass('label', this.state.formErrors.firstName)}>
                            {this.state.formErrors.firstName}</small>*/}

                    </div>
                    <div className="form-group col-6 pl-1">
                        <EloquaField id="field1" name="lastName" value={this.props.lastName} placeholder="Last Name"
                                     onChange={(event) => this.handleUserInput(event)}
                                     errorClass={this.errorClass("input", this.state.formErrors.lastName)}/>
                        {/*                        <input type="text"
                               className={`form-control form-control-sm ${this.errorClass("input", this.state.formErrors.lastName)}`}
                               id="lastName"
                               name="lastName" onChange={(event) => this.handleUserInput(event)}
                               placeholder="Last Name"/>
                        <small className={this.errorClass('label', this.state.formErrors.lastName)}>
                            {this.state.formErrors.lastName}</small>*/}
                    </div>
                </div>

                <div className="row">

                    <div className="form-group col-12">
                        <EloquaField id="field2" name="company" value={this.props.company} placeholder="Company"
                                     onChange={(event) => this.handleUserInput(event)}
                                     errorClass={this.errorClass("input", this.state.formErrors.company)}/>

                        {/*                        <input type="text"
                               className={`form-control form-control-sm ${this.errorClass("input", this.state.formErrors.company)}`}
                               id="company"
                               name="company" onChange={(event) => this.handleUserInput(event)}
                               placeholder="Company"/>
                        <small className={this.errorClass('label', this.state.formErrors.company)}>
                            {this.state.formErrors.company}</small>*/}
                    </div>
                    <div className="form-group col-12">

                        <EloquaField id="field3" name="title" value={this.props.title} placeholder="Job Title"
                                     onChange={(event) => this.handleUserInput(event)}
                                     errorClass={this.errorClass("input", this.state.formErrors.jobTitle)}/>

                        {/*                        <input type="text"
                               className={`form-control form-control-sm ${this.errorClass("input", this.state.formErrors.jobTitle)}`}
                               id="jobTitle"
                               name="jobTitle" onChange={(event) => this.handleUserInput(event)}
                               placeholder="Job Title"/>
                        <small className={this.errorClass('label', this.state.formErrors.jobTitle)}>
                            {this.state.formErrors.jobTitle}</small>*/}


                    </div>


                    <div className="form-group col-12">
                        <EloquaField id="field2" name="emailAddress" value={this.props.emailAddress}
                                     placeholder="Email Address" fieldType="email"
                                     onChange={(event) => this.handleUserInput(event)}
                                     errorClass={this.errorClass("input", this.state.formErrors.email)}/>

                        {/*                        <input type="email"
                               className={`form-control form-control-sm ${this.errorClass("input", this.state.formErrors.email)}`}
                               id="email" name="email" onChange={(event) => this.handleUserInput(event)}
                               placeholder="Email Address"/>
                        <small className={this.errorClass('label', this.state.formErrors.email)}>
                            {this.state.formErrors.email}</small>*/}
                    </div>
                    <div className="form-group col-12">
                        <EloquaField id="field2" name="busPhone" value={this.props.busPhone} placeholder="Phone Number"
                                     minLength={9} maxLength={15} onChange={(event) => this.handleUserInput(event)}
                                     errorClass={this.errorClass("input", this.state.formErrors.phoneNumber)}/>

                        {/*                        <input type="text"
                               className={`form-control form-control-sm ${this.errorClass("input", this.state.formErrors.phoneNumber)}`}
                               id="phoneNumber"
                               name="phoneNumber" onChange={(event) => this.handleUserInput(event)}
                               placeholder="Phone Number"/>
                        <small className={this.errorClass('label', this.state.formErrors.phoneNumber)}>
                            {this.state.formErrors.phoneNumber}</small>*/}
                    </div>

                    <div className="form-group col-12 text-right">
                        <small className={this.errorClass('label', 'catchAll')}>
                        </small>
                        <button type="button" className="btn btn-primary btn-sm"
                                onClick={(e) => this.submitForm(e)}>Register
                        </button>
                    </div>
                </div>

            </>
        )

    }
}

RegisterForm.propTypes = {
    formSubmitted: PropTypes.func.isRequired,
    formName: PropTypes.string,
    firstName: PropTypes.string,
    lastName: PropTypes.string,
    company: PropTypes.string,
    title: PropTypes.string,
    emailAddress: PropTypes.string,
    busPhone: PropTypes.string
};

RegisterForm.defaultProps = {
    formName: "STRContentOfferingForm",
    firstName: null,
    lastName: null,
    company: null,
    title: null,
    emailAddress: null,
    busPhone: null
};