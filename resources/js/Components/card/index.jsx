import React from 'react'
import CardItem from '../cardListItem'

function Card({
  unprocessedCarts,
  listMyCart,
  setListMyCart
}) {
  return (
    <div className=" flex flex-wrap justify-center gap-8 max-w-5xl">
      {unprocessedCarts.length > 0 &&
        unprocessedCarts.map((product) => {
          return (
            <CardItem
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
