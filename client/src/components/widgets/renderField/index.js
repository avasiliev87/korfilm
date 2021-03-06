import React from 'react';
import { FormGroup, Label, Input } from 'reactstrap';

const renderField = ({ input, label, type, initValue, handleKeyEvent, meta: { asyncValidating, touched, error } }) => (
    <FormGroup>
        <Label htmlFor="login-email">{label}</Label>
    <div className={asyncValidating ? 'async-validating' : ''}>
        <Input type={type} {...input}
            onKeyPress={handleKeyEvent}
            value={initValue}
        />
        {touched && error && <div className="alert alert-danger">{error}</div>}
    </div>
    </FormGroup>
)

export default renderField;
