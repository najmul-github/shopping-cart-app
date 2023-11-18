import React from 'react';

const Label = ({ forInput, value }) => {
    return (
        <label htmlFor={forInput} className="block font-medium text-sm text-gray-700">
            {value}
        </label>
    );
};

export default Label;
