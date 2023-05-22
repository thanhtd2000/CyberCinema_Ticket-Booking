import React from 'react'
import { Col, Row, Typography } from 'antd'
import MovieItem from '@/components/Elements/MovieItem'
const { Title } = Typography
import style from './style.module.less'
function MoviePlaying() {
      return (
            <div className='container'>
                  <div className={style.moviePlaying}>
                        <Row>
                              <Col span={24}><Title level={3}>PHIM ĐANG CHIẾU</Title></Col>
                              <Col span={24}>
                                    <Row gutter={[{xs: 0 ,sm: 20,md: 20 ,lg:35,xl: 50}, 50]}>
                                          <MovieItem />
                                          <MovieItem />
                                          <MovieItem />
                                          <MovieItem />
                                          <MovieItem />
                                          <MovieItem />
                                          <MovieItem />
                                          <MovieItem />

                                    </Row>
                              </Col>
                        </Row>
                  </div>
            </div>
      )
}

export default MoviePlaying