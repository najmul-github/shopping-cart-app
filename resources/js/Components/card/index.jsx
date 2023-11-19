import React from 'react'
import Product from '../product'

function Card({
  unprocessedCarts,
  listMyCart,
  setListMyCart
}) {
  return (
    <div className=" flex flex-wrap justify-center gap-8 max-w-5xl">
      {unprocessedCarts.length > 0 &&
        unprocessedCarts.map((prodcartuct) => {
          return (
            <Product
              key={product.id}
              product={product}
              listMyCart={listMyCart}
              setListMyCart={setListMyCart}
            />
          )
        })}
    </div>
  )
}

export default Card
