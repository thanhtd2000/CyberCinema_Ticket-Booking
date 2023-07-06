import { request } from "@/configs/api.config";
import { TQueryCode } from "@/modules/movies";

export const getListProduct= () =>
request({ url: '/get/products', method: 'GET'});
export const getListDiscount = (token: string) =>
request({ url: '/get/discount/list', method: 'GET'},{token});
export const getListDiscountDetail = (token: string, params: TQueryCode) =>
request({ url: '/get/discount/detail', method: 'GET',params: { ...params }},{token});