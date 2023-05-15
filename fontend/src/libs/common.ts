import moment from 'moment';
export const ConvertDate = (date: Date) => moment(date).utc().format('YYYY-MM-DD');
