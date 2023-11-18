import React from 'react';

const ValidationErrors = ({ errors }) => {
    if (!errors || Object.keys(errors).length === 0) {
        return null;
    }

    return (
        <div className="mt-4">
            <div className="font-medium text-red-600">Whoops! Something went wrong.</div>
            <ul className="mt-3 list-disc list-inside text-sm text-red-600">
                {Object.keys(errors).map((key, index) => (
                    <li key={index}>{errors[key]}</li>
                ))}
            </ul>
        </div>
    );
};

export default ValidationErrors;
