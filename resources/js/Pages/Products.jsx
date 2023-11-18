import React, { useState, useEffect } from 'react';
import { Head } from '@inertiajs/inertia-react'
import Navbar from '@/Components/navbar'
import Button from '@/Components/button'
import ProductList from '@/Components/productList'
import CartListWrapper from '@/Components/cartListWrapper'
import CartListHeader from '@/Components/cartListHeader'
import CartListBody from '@/Components/cartListBody'
import CartListFooter from '@/Components/cartListFooter'
import axios from 'axios';

export default function Products({ products, cart, totalCalculatedPrice }) {
  const [isOpen, setIsOpen] = useState(false)
  const [listMyCart, setListMyCart] = useState([])
  const [user, setUser] = useState(null);
  const [isDropdownOpen, setIsDropdownOpen] = useState(false);

  useEffect(() => {
    setListMyCart(cart.items); // Update listMyCart when cart prop changes
    
    // Fetch user data on component mount or when the user logs in
    async function fetchUserData() {
      try {
        const response = await axios.get('/api/user');
        const userData = response.data;
        setUser(userData);
      } catch (error) {
        // Handle errors
        console.error('Error fetching user data:', error);
      }
    }

    fetchUserData();
  }, [cart.items]);

  const handleOpenSidebar = () => {
    setIsOpen(true)
  }

  const handleCloseSideBar = () => {
    setIsOpen(false)
  }

  const handleUserDropdown = () => {
    setIsDropdownOpen(!isDropdownOpen);
  };

  const handleLogout = async () => {
    try {
      // Make a logout request to your server-side logout endpoint
      await axios.post('/logout');
      window.location.reload(true)
      // Clear user data on successful logout
      setUser(null);
    } catch (error) {
      console.error('Error logging out:', error);
    }
  };

  // console.log(listMyCart)

  return (
    <>
      <Head title="Shopping Cart" />

      <Navbar>
        <div className="mb-2 sm:mb-0">
          <h1 className="text-2xl no-underline text-white hover:text-blue-dark font-bold">
            Shopping Cart App
          </h1>
        </div>
        <Button name="btn-mycart" type="button" onClick={handleOpenSidebar}>
          My Cart
        </Button>
        {user && (
          <div className="relative">
            <button className="text-white" onClick={handleUserDropdown}>
              {user.name}
            </button>
            {isDropdownOpen && (
              <div className="absolute bg-white shadow mt-2 py-2 w-32 rounded">
                <button onClick={handleLogout}>Logout</button>
              </div>
            )}
          </div>
        )}
      </Navbar>

      <section className="flex justify-center min-h-screen min-w-screen py-12 ">
        <ProductList
          products={products}
          listMyCart={listMyCart}
          setListMyCart={setListMyCart}
          handleOpenSidebar={handleOpenSidebar}
        />
      </section>

      <CartListWrapper isOpen={isOpen}>
        <CartListHeader onClick={handleCloseSideBar} />
        <CartListBody listMyCart={listMyCart} setListMyCart={setListMyCart}  cart={cart} />
        <CartListFooter listMyCart={listMyCart} />
      </CartListWrapper>
    </>
  )
}
