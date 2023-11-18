import React from 'react';

const Checkbox = ({ name, value, handleChange }) => {
    return (
        <input
            type="checkbox"
            name={name}
            checked={value}
            onChange={handleChange}
        />
    );
};

export default Checkbox;
