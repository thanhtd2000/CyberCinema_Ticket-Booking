export type TProduct = {
      id: string,
      name : string,
      image: string,
      price: number,
      amount: number,
      count: number,
      quantity: number,
}
export type TDiscount = {
      id: string,
      code: string,
      end_time: string,
      count: number,
      max_price: number,
      min_price: number,
      percent: number,
      start_time: number
}