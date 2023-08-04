import { request } from '@/configs/api.config';
export const getProfile = (token: string) => request({ url: 'users/profile', method: 'GET' }, { token });
export const pathProfile = (token: string, body: any) => request({ url: 'users/update-profile', method: 'POST', data: body }, { token });
export const pathPassword = (token: string, body: any) => request({ url: '/users/update-password', method: 'POST', data: body }, { token });
export const getNewPassword = (body: any) => request({ url: 'send/code', method: 'POST', data: body });
export const getCheckCode = (body: any) => request({ url: 'check/code', method: 'POST', data: body });
export const getContact = (body: any) => request({ url: 'contact', method: 'POST', data: body });
