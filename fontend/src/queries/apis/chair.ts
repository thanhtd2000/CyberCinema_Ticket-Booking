import { request } from "@/configs/api.config";
import { TSchedule, TUpdateStatusChair } from "@/modules/movies";


export const updateStatusChair = (params:TUpdateStatusChair,token: string) =>
request({ url: '/update-status-seat', method: 'PATCH', params: { ...params } },{ token });

