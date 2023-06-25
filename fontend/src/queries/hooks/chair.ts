import { TResApi, TResApiErr, TResDataListApi } from '@/configs/interface.config';
import { TChair, TQueryUpdateChair, TSchedule, TUpdateStatusChair } from '@/modules/movies';
import { useMutation, useQuery, useQueryClient } from 'react-query';
import { updateStatusChair } from '../apis/chair';
import { UPDATE_STATUS_CHAIR } from '../keys/movies';
import { checkAuth } from '@/libs/localStorage';
import logger from '@/libs/logger';

  export const useQueryPatchChair = () => {
      return useMutation(({params, token} : {params:TUpdateStatusChair, token: string}) => updateStatusChair(params,token), {
        onSuccess: (data: TResApi) => {
          logger.debug('SignOut data:', data);
        },
        onError: (error: TResApiErr) => {
          logger.error('SignOut error:', error);
        }
      });
    };