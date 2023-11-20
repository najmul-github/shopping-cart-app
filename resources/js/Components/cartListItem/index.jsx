import React from 'react'
import axios from 'axios'
import Button from '../button'
import Input from '../input'

function CartListItem({ cartItem, listMyCart, setListMyCart }) {
  const { id, name, image_url, price, pivot } = cartItem
  const quantity = pivot ? pivot.quantity : 1;

  const handleRemoveCartItem = async () => {
    const newListMyCart = listMyCart.filter((cartItem) => cartItem.id !== id)

    setListMyCart(newListMyCart)
    try {
      await axios.delete(`/remove-from-cart/${pivot.id}`);
      const newListMyCart = listMyCart.filter((item) => item.pivot.id !== pivot.id);
      setListMyCart(newListMyCart);
    } catch (error) {
      console.error('Error removing item from cart:', error);
    }
  }

  const handleTextQuantity = (e) => {
    e.preventDefault()

    const newQuantity = Number(e.target.value)

    const updateQuantity = listMyCart.map((cartItem) => {
      if (cartItem.pivot && cartItem.pivot.product_id === id) {
        try {
          axios.put(`/edit-cart-item/${cartItem.pivot.id}`, { new_quantity: newQuantity })
            .then((response) => { })
            .catch((error) => {
              console.error('Error updating quantity:', error);
            });
        } catch (error) {
          console.error('Error updating quantity:', error);
        }

        return { ...cartItem, pivot: { ...cartItem.pivot, quantity: newQuantity } }
      }
      return cartItem
    })

    setListMyCart(updateQuantity)
  }

  const increaseQuantity = () => {
    const updateQuantity = listMyCart.map((cartItem) => {
      if (cartItem.pivot && cartItem.pivot.product_id === id) {
        const updatedQuantity = (cartItem.pivot.quantity || 0) + 1; // Ensure quantity exists
        handleQuantityChange(updatedQuantity);
        return {
          ...cartItem,
          pivot: {
            ...cartItem.pivot,
            quantity: updatedQuantity
          }
        };
      }
      return cartItem
    })

    setListMyCart(updateQuantity)
  }

  const decreaseQuantity = () => {
    if (quantity <= 0) {
      handleRemoveCartItem()
    } else {
      const updateQuantity = listMyCart.map((cartItem) => {
        if (cartItem.pivot && cartItem.pivot.product_id === id) {

          const updatedQuantity = (cartItem.pivot.quantity || 0) - 1; // Ensure quantity exists
          handleQuantityChange(updatedQuantity);
          return {
            ...cartItem,
            pivot: {
              ...cartItem.pivot,
              quantity: updatedQuantity
            }
          };
        }
        return cartItem
      })

      setListMyCart(updateQuantity)
    }
  }

  const handleQuantityChange = (updatedQuantity) => {
    if (cartItem.pivot && cartItem.pivot.id) {
    axios.put(`/edit-cart-item/${cartItem.pivot.id}`, { new_quantity: updatedQuantity })
      .then((response) => {})
      .catch((error) => {
        console.error('Error updating quantity:', error);
      });
    } else {
      console.error('Pivot ID not available for item:', cartItem);
    }
  };


  return (
    <div className="flex flex-col h-fit md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg ">
      <img
        className=" w-full h-auto self-center md:ml-2 md:h-44 object-cover md:w-36 rounded-t-lg md:rounded-none md:rounded-l-lg"
        src={image_url}
        alt={name}
      />
      <div className="p-6 flex flex-col justify-start">
        <button
          className="self-end w-6 font-bold text-white bg-red-600 rounded text-md mb-2 hover:bg-black hover:bg-opacity-5 hover:text-red-600"
          type="button"
          onClick={handleRemoveCartItem}
        >
          x
        </button>
        <h5 className="text-gray-900 text-lg font-bold mb-2">{name}</h5>
        <p className="text-red-600 font-bold mb-4">$ {price}</p>

        <div className="flex items-center justify-start">
          <div
            className="inline-flex shadow-md hover:shadow-lg focus:shadow-lg h-8"
            role="group"
          >
            <Button
              name="btn-minus"
              type="button"
              className="py-0 rounded-r-none"
              onClick={decreaseQuantity}
            >
              -
            </Button>

            <Input
              type="number"
              name="input-quantity"
              width="w-16"
              value={quantity}
              onChange={handleTextQuantity}
            />

            <Button
              name="btn-plus"
              type="button"
              className="py-0 rounded-l-none"
              onClick={increaseQuantity}
            >
              +
            </Button>
          </div>
        </div>
      </div>
    </div>
  )
}

export default CartListItem
