import React, { useState } from 'react'
import style from './style.module.less'
import Image from 'next/image'
import VideoIframe from '../VideoTrailer';
import { FiYoutube } from 'react-icons/fi';
import { AiFillStar } from 'react-icons/ai';
import { Col, Row, Typography, Button, Modal } from 'antd'
const { Title, Paragraph } = Typography
function BannerItem() {
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
            <div className={style.bannerItem}>
                  <div className={style.blur}>
                  </div>
                  <Image src='/images/bannerMoviejpg.jpg' width={1519} height={600} alt='banner' />
                  <Row className={style.content}>
                        <Col span={24} className={style.start}>
                              <ul>
                                    <li><AiFillStar /></li>
                                    <li><AiFillStar /></li>
                                    <li><AiFillStar /></li>
                                    <li><AiFillStar /></li>
                                    <li><AiFillStar /></li>
                              </ul>
                        </Col>
                        <Col span={24}>
                              <Title level={3}>HACKSAW RIDGE</Title>
                        </Col>
                        <Col span={24}><Paragraph className={style.name}>2D Digital</Paragraph></Col>
                        <Col span={24}><Button className={style.trailer} onClick={showModal} icon={<FiYoutube></FiYoutube>}>Watch Trailer</Button></Col>
                        <Modal title="Trailer Hacksaw " footer={false} width={1000} open={isModalOpen} onOk={handleOk} onCancel={handleCancel}>
                              <VideoIframe  videoLink={videoLink} title={videoTitle} />
                        </Modal>
                  </Row>
            </div>
      )
}

export default BannerItem