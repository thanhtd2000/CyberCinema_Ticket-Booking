import { request } from "@/configs/api.config";
import { TQueryPayment } from "@/modules/movies";

export const getPayment = (params:TQueryPayment,token: string) =>
request({ url: 'get/payment', method: 'GET', params: { ...params } },{ token });