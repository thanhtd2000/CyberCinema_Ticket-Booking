import { useMutation, useQuery, useQueryClient } from 'react-query';
import { toast } from 'react-toastify';

import { checkAuth, clearStoredAuth, getStoredAuth, setStoredAuth } from '@libs/localStorage';
import logger from '@libs/logger';
import { TResApi, TResApiErr } from '@configs/interface.config';
import { TAuth, TRegister, TRole, TSignature, TUser } from '@/modules';

import { refreshToken, register, signIn, signOut } from '../apis';
import { USER_CURRENT_ROLE, USER_PROFILE } from '../keys';
import { getProfile } from '../apis/user';
import { getRoleCurrent } from '../apis/role';

/**
 * @method useQuerySignIn
 * @returns
 */
export const useMutationSignIn = () => {
  const queryClient = useQueryClient();
  return useMutation(signIn, {
    onSuccess: async (res: TResApi<TAuth>) => {
      setStoredAuth(res.data.auth);
      toast.success(res.message);
    },
    onError: (error: TResApiErr) => {
      void clearStoredAuth();
      toast.error(error.message || error.statusText);
    },
    onSettled: () => {
      queryClient.invalidateQueries();
    },
  });
};

/**
 * @method useMutationSignOut
 * @returns
 */
export const useMutationSignOut = () => {
  const queryClient = useQueryClient();
  const accessToken = checkAuth();
  return useMutation(() => signOut(accessToken), {
    onSuccess: (data: TResApi) => {
      logger.debug('SignOut data:', data);
      // Todo
    },
    onError: (error: TResApiErr) => {
      logger.error('SignOut error:', error);
      // Todo
    },
    onSettled(data, error, variables, context) {
      logger.debug('signOut onSettled', data, error, variables, context);
      queryClient.invalidateQueries();
      void clearStoredAuth();
    },
  });
};

/**
 * @method useQueryProfile
 * @returns
 */
export const useQueryProfile = (token: string) =>
  useQuery<TResApi<TUser>>([USER_PROFILE], () => getProfile(token), {
    enabled: !!token,
    refetchOnMount: true,
    refetchOnReconnect: true,
    refetchOnWindowFocus: true,
    retry: 2,
  });

/**
 * @method useQueryRoleCurrent
 * @returns
 */
export const useQueryRoleCurrent = (token: string) =>
  useQuery<TResApi<TRole[]>>([USER_CURRENT_ROLE], () => getRoleCurrent(token), {
    enabled: !!token,
    refetchOnMount: true,
    refetchOnReconnect: true,
    refetchOnWindowFocus: true,
    retry: 2,
  });

/**
 * @method refreshTokenFn
 * @returns
 */
export const refreshTokenFn: () => void = async () => {
  const signature: TSignature | null = getStoredAuth();
  if (signature) {
    const result: TResApi = await refreshToken(signature.accessToken, signature?.refreshToken || '');
    if (result.statusCode === 200) {
      setStoredAuth({
        ...signature,
        accessToken: result.data.accessToken,
        expiredAt: result.data.expiredAt,
      });
    }
    return result;
  }
  // TODO ...
  return false;
};


export const useRegister = () => {
      const queryClient = useQueryClient();
      return useMutation((body: TRegister) => register(body), {
        onSuccess: (res: TResApi<TAuth>) => {
          // toast.success(res.message);
          logger.debug('Register res:', res);
          // Todo
        },
        onError: (error: TResApiErr) => {
          // toast.error(error.message || error.statusText);
          logger.debug('Register error:', error);
        },
        onSettled: (data, error, variables, context) => {
          logger.debug('Register onSettled', data, error, variables, context);
          queryClient.invalidateQueries();
        },
      });
};