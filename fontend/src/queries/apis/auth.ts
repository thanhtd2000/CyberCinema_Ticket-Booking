import { request } from '@/configs/api.config';
import { TRegister, TSignIn } from '@modules/auth';

export const signIn = (body: TSignIn) => request({ url: 'auth/login', method: 'POST', data: body });
export const signOut = (token: string) => request({ url: 'auth/logout', method: 'POST' }, { token });
export const refreshToken = (token: string, refreshToken: string) =>
  request({ url: 'auth/refresh-token', method: 'POST', data: { refreshToken } }, { token });
export const register = (body: TRegister) => request({ url: 'auth/register', method: 'POST', data: body });
