import React from 'react';
import './guest.css'; // Import your CSS file if you're using an external stylesheet

const Guest = ({ children }) => {
    return (
        <div className="container">
            <div className="row">
                <div className="col-md-12">
                    <main>
                        {/* Render the content passed as children */}
                        {children}
                    </main>
                </div>
            </div>
        </div>
    );
};

export default Guest;
