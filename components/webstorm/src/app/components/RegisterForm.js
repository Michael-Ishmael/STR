import {Component} from "react";
import React from "react";
import {apiLogDownload} from "../services/server";


export class RegisterForm extends Component {

    constructor(props) {
        super(props);
        this.initialiseState();
    }

    initialiseState() {
        this.state = {
            firstName: null,
            lastName: null,
            company: null,
            jobTitle: null,
            email: null,
            phoneNumber: null,
            formErrors: {}
        }
    }

    handleUserInput(e) {
        const name = e.target.name;
        const value = e.target.value;
        this.setState({[name]: value}, () => this.validateAll());
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
            jobTitle: this.validateField('jobTitle'),
            email: this.validateField('email'),
            phoneNumber: this.validateField('phoneNumber'),
        };
        const errors = Object.keys(formErrors).map(key => formErrors[key]).filter(o => o != null && o.length > 0);
        this.setState({formErrors: formErrors, formValid: errors.length === 0}, () => {
            if (doneFunc) doneFunc();
        })
    }

    submitForm() {

        this.validateAll(() => {
            if (!this.state.formValid) {
                this.setState({showErrors: true});
            } else {
                const { firstName, lastName, company, jobTitle, email, phoneNumber } = this.state;
                const details = { firstName, lastName, company, jobTitle, email, phoneNumber };
                this.props.formSubmitted(details);
            }
        });

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
            <div>

                <div className="form-row">
                    <div className="form-group col-6 pr-1">
                        <input type="text"
                               className={`form-control form-control-sm ${this.errorClass("input", this.state.formErrors.firstName)}`}
                               name="firstName" id="firstName"
                               onChange={(event) => this.handleUserInput(event)}
                               placeholder="First Name"/>
                        <small className={this.errorClass('label', this.state.formErrors.firstName)}>
                            {this.state.formErrors.firstName}</small>

                    </div>
                    <div className="form-group col-6 pl-1">
                        <input type="text"
                               className={`form-control form-control-sm ${this.errorClass("input", this.state.formErrors.lastName)}`}
                               id="lastName"
                               name="lastName" onChange={(event) => this.handleUserInput(event)}
                               placeholder="Last Name"/>
                        <small className={this.errorClass('label', this.state.formErrors.lastName)}>
                            {this.state.formErrors.lastName}</small>
                    </div>
                </div>

                <div className="row">


                    <div className="form-group col-12">
                        <input type="text"
                               className={`form-control form-control-sm ${this.errorClass("input", this.state.formErrors.company)}`}
                               id="company"
                               name="company" onChange={(event) => this.handleUserInput(event)}
                               placeholder="Company"/>
                        <small className={this.errorClass('label', this.state.formErrors.company)}>
                            {this.state.formErrors.company}</small>
                    </div>
                    <div className="form-group col-12">
                        <input type="text"
                               className={`form-control form-control-sm ${this.errorClass("input", this.state.formErrors.jobTitle)}`}
                               id="jobTitle"
                               name="jobTitle" onChange={(event) => this.handleUserInput(event)}
                               placeholder="Job Title"/>
                        <small className={this.errorClass('label', this.state.formErrors.jobTitle)}>
                            {this.state.formErrors.jobTitle}</small>
                    </div>


                    <div className="form-group col-12">
                        <input type="email"
                               className={`form-control form-control-sm ${this.errorClass("input", this.state.formErrors.email)}`}
                               id="email" name="email" onChange={(event) => this.handleUserInput(event)}
                               placeholder="Email Address"/>
                        <small className={this.errorClass('label', this.state.formErrors.email)}>
                            {this.state.formErrors.email}</small>
                    </div>
                    <div className="form-group col-12">
                        <input type="number"
                               className={`form-control form-control-sm ${this.errorClass("input", this.state.formErrors.phoneNumber)}`}
                               id="phoneNumber"
                               name="phoneNumber" onChange={(event) => this.handleUserInput(event)}
                               placeholder="Phone Number"/>
                        <small className={this.errorClass('label', this.state.formErrors.phoneNumber)}>
                            {this.state.formErrors.phoneNumber}</small>
                    </div>

                    <div className="form-group col-12 text-right">
                        <small className={this.errorClass('label', 'catchAll')}>
                            </small>
                        <button className="btn btn-primary btn-sm" onClick={(e) => this.submitForm(e)} >Register
                        </button>
                    </div>
                </div>

            </div>
        )

    }
}