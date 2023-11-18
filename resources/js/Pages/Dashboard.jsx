import React from 'react';
import axios from 'axios';

function AdminDashboard({ unprocessedCarts }) {
  const handleStatusUpdate = async (cartId, status) => {
    try {
      await axios.put(`/admin/orders/${cartId}/status`, { status });
      // Handle any post-update actions or UI changes
    } catch (error) {
      console.error('Error updating status:', error);
    }
  };

  return (
    <div className="container-fluid dashboard-content vh-100">
      <h3 className="py-3">Admin Dashboard - Orders/Cart Details</h3>
      <div className="row mt-3 mb-5">
        {unprocessedCarts.map((cart) => (
          <div className="col-md-4 mb-2" key={cart.id}>
            {/* Card setup */}
            {/* ... */}
            <div className="card-body pt-0">
              <div className="row text-start">
                <div className="col-md-12">
                  <span>Cart Summary:</span>
                </div>
                <div className="col-md-10 timeline-status-count">
                  <div className="cart-summary">
                    <ul>
                      {cart.items.map((item) => (
                        <li key={item.id}>
                          {item.name}({item.pivot.quantity}) - ${item.price}
                        </li>
                      ))}
                    </ul>
                  </div>
                </div>
              </div>
              <div className="row mt-4">
                <div className="col-md-4">
                  <div className="assigned">
                    <p className="follow-up">
                      Total Product ::
                      <span className="count">{cart.items.length}</span>
                    </p>
                  </div>
                </div>
                {/* ... Other columns */}
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

export default AdminDashboard;
