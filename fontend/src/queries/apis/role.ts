import { request } from '@configs/api.config';

export const getRoleCurrent = (token: string) => request({ url: 'role/current', method: 'GET' }, { token });
