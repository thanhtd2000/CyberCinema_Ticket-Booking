import { request } from "@/configs/api.config";
import { TQueryPayment } from "@/modules/movies";

export const getPayment = (params:TQueryPayment,token: string) =>
request({ url: 'get/payment', method: 'GET', params: { ...params } },{ token });
export const getHistory = (token: string) =>
request({ url: 'get/tickets', method: 'GET'},{ token });
export const getPoint = (token: string) =>
request({ url: 'get/points', method: 'GET'},{ token });