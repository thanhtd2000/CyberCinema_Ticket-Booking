import { request } from '@/configs/api.config';

export const getProfile = (token: string) => request({ url: 'user/profile', method: 'GET' }, { token });
export const pathProfile = (token: string, body: any) => request({ url: 'users/update-profile', method: 'POST', data: body }, { token });
