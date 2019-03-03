import React, {Component} from "react";
import PropTypes from 'prop-types';

export class EloquaField extends Component {

    constructor(props) {
        super(props)
        this.initialiseState()
    }

    initialiseState() {

        this.state = {
            value: this.props.value || ""
        }
    }

    componentWillReceiveProps(nextProps ){
        if(this.props.value !== nextProps.value)
            this.setState({value: nextProps.value});
    }

    componentDidMount() {
        const {_field} = this.refs;
        if (!_field) return;
        const valField = new LiveValidation(_field, {
            validMessage: "", onlyOnBlur: false, wait: 300
        });
        valField.add(Validate.Custom, {
            against: function (value) {
                return !value.match(/(<([^>]+)>)/ig);
            }
            , failureMessage: "Must not contain HTML tags"
        })
        valField.add(Validate.Length, {
                tooShortMessage: "Entry too short", tooLongMessage: "Entry too long",
                minimum: this.props.minLength, maximum: this.props.maxLength
            }
        );
        valField.add(Validate.Presence, {
                failureMessage: "Input required"
            }
        );
        valField.add(Validate.Custom, {
                against: function (value) {
                    return !value.match(/(telnet|ftp|https?):\/\/(?:[a-z0-9][a-z0-9-]{0,61}[a-z0-9]\.|[a-z0-9]\.)+[a-z]{2,63}/i);
                }
                , failureMessage: "Entry must not contain URLs"
            }
        );
        if (this.props.fieldType.toLowerCase() === "email") {
            valField.add(Validate.Format, {
                    pattern: /^([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]{2,})$/i,
                    failureMessage: "A valid email address is required"
                }
            );
        }
    }

    fireOnChange(event){
        this.setState({value: event.target.value});
        this.props.onChange(event);
    }

    render() {

        return (
            <div id={"formElement-" + this.props.id}
                 className="sc-view form-design-field sc-static-layout item-padding sc-regular-size">
                <div className="field-wrapper">
                </div>
                <div className="individual field-wrapper">
                    <div className="_100 field-style">
                        <p className="field-p">
                            <label htmlFor={this.props.id} className="">
              <span className="required">
                *
              </span>
                            </label>
                            <input id={this.props.id} name={this.props.name} type="text"
                                   placeholder={this.props.placeholder}
                                   ref="_field" className={`form-control form-control-sm ${this.props.errorClass}`}
                                   value={this.state.value}
                                   onChange={(event) => this.fireOnChange(event)}
                            />
                        </p>
                    </div>
                </div>
            </div>
        );

    }

}

EloquaField.propTypes = {
    id: PropTypes.string.isRequired,
    name: PropTypes.string.isRequired,
    value: PropTypes.string,
    placeholder: PropTypes.string.isRequired,
    onChange: PropTypes.func.isRequired,
    fieldType: PropTypes.string,
    errorClass: PropTypes.string,
    minLength: PropTypes.number,
    maxLength: PropTypes.number
};

EloquaField.defaultProps = {
    fieldType: "text",
    errorClass: "",
    value: "",
    minLength: 0,
    maxLength: 35
};





