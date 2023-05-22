import React, { useState } from 'react'
import { Col, Row, Typography, Tag, Button, Space, Modal } from 'antd'
const { Title } = Typography
import { AiFillPlayCircle } from 'react-icons/ai';
import Image from 'next/image'
import style from './style.module.less'
import VideoIframe from '../VideoTrailer';
function MovieItem() {
      const [isModalOpen, setIsModalOpen] = useState(false);
      const videoLink = 'https://youtu.be/yKt0eL4Rv6o'
      const videoTitle = "[전인혁작곡] 야다(Yada) - 약속 (2019 ver)";

      const showModal = () => {
            setIsModalOpen(true);
      };

      const handleOk = () => {
            setIsModalOpen(false);
      };

      const handleCancel = () => {
            setIsModalOpen(false);
      };
      return (
            <Col xs={24} sm={12} md={8} lg={8} xl={6} className={style.movieItem}>
                  <Row gutter={[{xs: 24}, 10]}>
                        <Col xs={12} sm={24} md={24} lg={24} xl={24} className={style.movieImage}>
                              <Image src='/images/imgMovie1jpg.jpg' width={227} height={300} alt='' />
                              <span onClick={showModal} className={style.playTrailer}><AiFillPlayCircle></AiFillPlayCircle></span>
                              <Modal title="Trailer Hacksaw " footer={false} width={1000} open={isModalOpen} onOk={handleOk} onCancel={handleCancel}>
                                    <VideoIframe videoLink={videoLink} title={videoTitle} />
                              </Modal>
                              <Space className={style.movieHot}>
                                    <Tag>C18</Tag>
                                    <Tag>Hot</Tag>
                              </Space>
                        </Col>
                        <Col xs={12} sm={24} md={24} lg={24} xl={24}>
                              <Row>
                                    <Col span={24}>
                                          <Title level={4}>Lật Mặt 6: Tấm Vé Định Mệnh</Title>
                                    </Col>
                                    <Col span={24} className={style.movieType}>
                                          <span style={{color: '#fff'}}>Thể loại: </span>
                                          <Tag className={style.tag}>Hành động</Tag>
                                          <Tag className={style.tag}>Tình cảm</Tag>
                                    </Col>
                                    <Col span={24} className={style.movieType}>
                                          <span style={{color: '#fff'}}>Thời lượng: </span>
                                          <Tag className={style.tag}>98 phút</Tag>
                                    </Col>
                                    <Col span={24}>
                                          <Button>Mua vé</Button>
                                    </Col>
                              </Row>
                        </Col>
                  </Row>
            </Col>
      )
}

export default MovieItem