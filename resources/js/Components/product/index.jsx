import React from 'react'
import Button from '../button'
import axios  from 'axios' 

function Product({ product, listMyCart, setListMyCart, handleOpenSidebar }) {
  const { id, image_url, name, price } = product

  const handleAddProductIntoListMyCart = () => {
    handleOpenSidebar()
    const isCartItemExist = listMyCart.some((cartItem) => {
      if (cartItem.pivot && cartItem.pivot.product_id === id) {
        // Notifies the server about the change
        axios.post(`/add-to-cart`, { id: product.id })
          .then((response) => {})
          .catch((error) => {
            console.error('Error updating quantity:', error);
        });
        return true
      }
      return false
    })

    if (isCartItemExist) {
      const updateCartItem = listMyCart.map((cartItem) => {
        if (cartItem.pivot && cartItem.pivot.product_id === id) {
          const updatedQuantity = (cartItem.pivot.quantity || 0) + 1; // Ensure quantity exists
          return {
            ...cartItem,
            pivot: {
              ...cartItem.pivot,
              quantity: updatedQuantity
            }
          };
        }
        return cartItem;
      })

      setListMyCart(updateCartItem)
    } else {
      // New item - Add it to the cart
      const newCartItem = {
        id,
        image_url,
        name,
        price,
        pivot: {
          product_id: id,
          quantity: 1, // Initial quantity for a new item
        },
      };
      try {
        axios.post(`/add-to-cart`, { id: product.id })
        .then((response) => {
          setListMyCart([...listMyCart, newCartItem]);
        })
        .catch((error) => {
            console.error('Error updating quantity:', error);
        });
      } catch (error) {
        console.error('Error adding item to cart:', error);
      }
    }
  }

  return (
    <div className="max-w-xs rounded overflow-hidden bg-white shadow-lg">
      <img className="w-full" src={product.image_url} alt={product.title} />
      <div className="px-6 py-2">
        <h3 className="font-bold text-xl mb-2">{product.name}</h3>
        <p className="mb-2">{product.description}</p>
        <p className="text-red-600 font-bold">$ {product.price}</p>
      </div>
      <div className="px-6">
        <Button
          name="btn-addToMyCart"
          type="button"
          className="mb-4"
          onClick={handleAddProductIntoListMyCart}
        >
          Add to My Cart
        </Button>
      </div>
    </div>
  )
}

export default Product
