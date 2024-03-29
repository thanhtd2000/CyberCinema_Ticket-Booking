import React from 'react'
import { Col, Row, Typography } from 'antd'
import MovieItem from '@/components/Elements/MovieItem'
const { Title } = Typography
import style from './style.module.less'
import { TMovies } from '@/modules/movies'
import { useTranslation } from 'react-i18next'
interface movies{
      fetchAllMovies: TMovies[];
}
function MoviePlaying({fetchAllMovies}:movies) {
      const { t } = useTranslation();
      return (
            <div className='container'>
                  <div className={style.moviePlaying}>
                        <Row>
                              <Col span={24}><Title level={3}>{t('home:playing')}</Title></Col>
                              <Col span={24}>
                                    <Row gutter={[{xs: 0 ,sm: 20,md: 20 ,lg:35,xl: 50}, 50]}>
                                          {fetchAllMovies && fetchAllMovies ? fetchAllMovies?.map((item)=> (<MovieItem movies={item} />)) : <div>loading...</div>}
                                    </Row>
                              </Col>
                        </Row>
                  </div>
            </div>
      )
}

export default MoviePlaying