import React, { createContext, useState, useEffect } from 'react';
import axios from 'axios';

export const CartContext = createContext();

export const CartProvider = ({ children }) => {
  const [listMyCart, setListMyCart] = useState([]);

  useEffect(() => {
    async function fetchCartData() {
      try {
        const response = await axios.get('/api/cart');
        const cartData = response.data;
        setListMyCart(cartData);
      } catch (error) {
        console.error('Error fetching cart data:', error);
      }
    }

    fetchCartData();
  }, []);

  return (
    <CartContext.Provider value={{ listMyCart, setListMyCart }}>
      {children}
    </CartContext.Provider>
  );
};
