import { request } from '@/configs/api.config';

export const getProfile = (token: string) => request({ url: 'users/profile', method: 'GET' }, { token });
export const pathProfile = (token: string, body: any) => request({ url: 'users/update-profile', method: 'POST', data: body }, { token });
export const pathPassword = (token: string, body: any) => request({ url: '/users/update-password', method: 'POST', data: body }, { token });
