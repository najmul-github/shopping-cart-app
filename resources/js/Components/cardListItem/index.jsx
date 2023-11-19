import React, { useState } from 'react';
import Button from '../button'
import axios from 'axios'

function cardListItem({ product, listMyCart, setListMyCart, handleOpenSidebar }) {
  const [status, setStatus] = useState(product.status);

  const handleStatusChange = (event) => {
    setStatus(event.target.value);
  };
  const handleSubmit = (event) => {
    event.preventDefault();
    // Use 'status' state to submit or update data via API call
    axios.put(`/admin/carts/${product.id}/status`, { status })
      .then((response) => {
        // Handle successful update
      })
      .catch((error) => {
        // Handle error
      });
  };

  return (
    <div className="max-w-xs rounded overflow-hidden bg-white shadow-lg">
      <h3 className="text-center text-lg font-semibold py-2">Cart Details</h3>
      <hr />
      <div className="card text-center card-setup">
        <div className="card-header header-style border-0 mb-0">
          <div className="row row-cols-lg-2 row-cols-1">
            <div className="col text-end pt-2">
              <form onSubmit={handleSubmit}>
                <select name="status" className="form-control" value={status} onChange={handleStatusChange}>
                  <option value="pending">Pending</option>
                  <option value="shipped">Shipped</option>
                  <option value="delivered">Delivered</option>
                </select>
                <Button
                  name="btn-addToMyCart"
                  type="submit"
                  className="mb-2"
                >
                  Update
                </Button>
              </form>
            </div>
          </div>
          <hr />
        </div>
        <div className="card-body pt-0">
          <div className="row text-center mb-4"><h4 className="text-md font-semibold">Cart Summary</h4>
            <div className="col-md-10 timeline-status-count">
              <div className="cart-summary">
                <ul>
                  {product.items.map(item => (
                    <li key={item.id} className="py-2 border-b">
                      <span className="text-sm"> {item.name} ({item.pivot.quantity}) - <b className="text-red-600 font-bold">$ {item.price}</b></span>
                    </li>
                  ))}
                </ul>
              </div>
            </div>
          </div>
          <div className="row mt-4">
            <div className="col-md-4">
              <div className="assigned">
                <p className="py-1 text-sm">
                  Total Product :: <span className="count">{product.items.length}</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default cardListItem
