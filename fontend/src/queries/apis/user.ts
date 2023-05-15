import { request } from '@/configs/api.config';

export const getProfile = (token: string) => request({ url: 'user/profile', method: 'GET' }, { token });
