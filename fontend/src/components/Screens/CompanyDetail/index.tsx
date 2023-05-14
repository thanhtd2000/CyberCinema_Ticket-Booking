import React, { useState } from 'react';
import { Row, Col, Typography, Button, Breadcrumb, Space, Tag } from 'antd';
import { useTranslation } from 'next-i18next';
import Link from 'next/link';
import { GiEarthAmerica } from 'react-icons/gi';
import { VscNotebook, VscFileSubmodule } from 'react-icons/vsc';
import { ImNewspaper } from 'react-icons/im';
import { MdOutlineGroups } from 'react-icons/md';
import { BiArrowToTop } from 'react-icons/bi';
import { BsPersonVcard, BsCheck2All, BsFillBoxSeamFill, BsBoxes } from 'react-icons/bs';
import Image from 'next/image';

import style from './style.module.less';

const { Title, Paragraph } = Typography;
function CompanyDetail() {
  const [open, setOpen] = useState(true);
  const { t } = useTranslation();
  const [toggle, SetToggle] = useState(1);
  const truncateString = (str: string, num: number) => {
    if (str?.length > num) {
      return `${str.slice(0, num)} ...`;
    }
    return str;
  };
  const toggleTab = (i: number) => {
    SetToggle(i);
    console.log(toggle);
  };
  return (
    <div style={{ backgroundColor: '#efe9e9' }}>
      <div className='container'>
        <div className='CompanyDetail'>
          <div className={style.companyDetail}>
            <Row>
              <Col span={24} style={{ paddingBottom: '24px' }}>
                <Breadcrumb
                  className={style.breadcrumb}
                  items={[
                    {
                      title: <Link href='/'>{t('home_page')}</Link>,
                    },
                    {
                      title: 'Danh mục công ty',
                    },
                  ]}
                />
              </Col>
              <Col span={24}>
                <div className={style.backgroundBanner}>
                  <Space className={style.headerCompany}>
                    <Row>
                      <Col span={24} className={style.banner}>
                        <Image src='/images/image 639.png' width={1156} height={234} alt='background' />
                      </Col>
                      <Col span={24}>
                        <Row gutter={[{ xs: 0, sm: 0, md: 0, lg: 56 }, 0]} className={style.header}>
                          <Col className={style.logo}>
                            <Image src='/images/Frame 195.png' width={150} height={150} alt='logo' />
                          </Col>
                          <Col className={style.headerBottom}>
                            <Row gutter={[0, 11]}>
                              <Col md={24} lg={24} xl={14} className={style.headerLeft}>
                                <Title level={5}>Tập đoàn Công nghiệp - Viễn thông Quân đội Viettel</Title>
                              </Col>
                              <Col md={24} lg={24} xl={10}>
                                <Row gutter={[18, 0]} className={style.headerRight}>
                                  <Col>
                                    <Button className={style.button1} icon={<GiEarthAmerica />}>
                                      Tìm hiểu thêm
                                    </Button>
                                  </Col>
                                  <Col>
                                    <Button className={style.button2} icon={<BsPersonVcard />}>
                                      Liên hệ
                                    </Button>
                                  </Col>
                                </Row>
                              </Col>
                              <Col md={24} lg={24} xl={14}>
                                <Tag className={style.tag}>Công nghệ thông tin</Tag>
                                <Tag className={style.tag}>Công nghệ thông tin</Tag>
                                <Tag className={style.tag}>Công nghệ thông tin</Tag>
                              </Col>
                              <Col xs={14} sm={14} md={14} lg={14} xl={10}>
                                <Row className={style.headerRight} gutter={[18, 0]}>
                                  <Col>
                                    <Paragraph className={style.paragraph}>Đã tham gia từ 02/2023</Paragraph>
                                  </Col>
                                  <Col className={style.check}>
                                    <span>
                                      <BsCheck2All style={{ paddingRight: '8px' }} />
                                      Đã xác minh
                                    </span>
                                  </Col>
                                </Row>
                              </Col>
                            </Row>
                          </Col>
                        </Row>
                      </Col>
                      <Col span={24}>
                        <Row className={style.tabs}>
                          <Col
                            onClick={() => toggleTab(1)}
                            className={toggle === 1 ? `${style.tabsItem} ${style.active}` : `${style.tabsItem}`}
                          >
                            <span>
                              <VscNotebook />
                            </span>
                            <span className={style.displayNone}>Tổng quan</span>
                          </Col>
                          <Col
                            onClick={() => toggleTab(2)}
                            className={toggle === 2 ? `${style.tabsItem} ${style.active}` : `${style.tabsItem}`}
                          >
                            <span>
                              <VscFileSubmodule />
                            </span>
                            <span className={style.displayNone}>Hồ sơ năng lực</span>
                          </Col>
                          <Col
                            onClick={() => toggleTab(3)}
                            className={toggle === 3 ? `${style.tabsItem} ${style.active}` : `${style.tabsItem}`}
                          >
                            <span>
                              <BsFillBoxSeamFill />
                            </span>
                            <span className={style.displayNone}>Sản phẩm</span>
                          </Col>
                          <Col
                            onClick={() => toggleTab(4)}
                            className={toggle === 4 ? `${style.tabsItem} ${style.active}` : `${style.tabsItem}`}
                          >
                            <span>
                              <BsBoxes />
                            </span>
                            <span className={style.displayNone}>Dịch vụ</span>
                          </Col>
                          <Col
                            onClick={() => toggleTab(5)}
                            className={toggle === 5 ? `${style.tabsItem} ${style.active}` : `${style.tabsItem}`}
                          >
                            <span>
                              <MdOutlineGroups />
                            </span>
                            <span className={style.displayNone}>Đội ngũ công ty</span>
                          </Col>
                          <Col
                            onClick={() => toggleTab(6)}
                            className={toggle === 6 ? `${style.tabsItem} ${style.active}` : `${style.tabsItem}`}
                          >
                            <span>
                              <ImNewspaper />
                            </span>
                            <span className={style.displayNone}>Post</span>
                          </Col>
                        </Row>
                      </Col>
                    </Row>
                  </Space>
                </div>
              </Col>
              <Col span={24} className={toggle === 1 ? `${style.none} ${style.tabContent}` : `${style.none}`}>
                <Row>
                  <Col span={24}>
                    <Row>
                      <Col span={17} className={style.intro}>
                        <Row gutter={[0, 16]}>
                          <Col span={24}>
                            <Title level={5}>Giới thiệu</Title>
                          </Col>
                          <Col span={24} style={{ paddingTop: '24px' }}>
                            <Row gutter={[24, 0]}>
                              <Col span={12}>
                                <span className={style.label}>Tên đầy đủ:</span>
                                <Paragraph className={style.content}>
                                  Tập đoàn Công nghiệp - Viễn thông Quân đội Viettel
                                </Paragraph>
                              </Col>
                              <Col span={12}>
                                <span className={style.label}>Tên quốc tế:</span>
                                <Paragraph className={style.content}>Viettel Group</Paragraph>
                              </Col>
                            </Row>
                          </Col>
                          <Col span={24}>
                            <Row gutter={[24, 0]}>
                              <Col span={12}>
                                <span className={style.label}>Mã số thuế:</span>
                                <Paragraph className={style.content}>0100683550-005</Paragraph>
                              </Col>
                              <Col span={12}>
                                <span className={style.label}>Địa chỉ:</span>
                                <Paragraph className={style.content}>
                                  Lô D26 Khu đô thị mới Cầu Giấy, Phường Yên Hòa, Quận Cầu Giấy, Hà Nội, Việt Nam
                                </Paragraph>
                              </Col>
                            </Row>
                          </Col>
                          <Col span={24}>
                            <Row gutter={[24, 0]}>
                              <Col span={12}>
                                <span className={style.label}>Ngày thành lập:</span>
                                <Paragraph className={style.content}>01/06/1989</Paragraph>
                              </Col>
                              <Col span={12}>
                                <span className={style.label}>Quy mô nhân sự:</span>
                                <Paragraph className={style.content}>50.000+ nhân viên</Paragraph>
                              </Col>
                            </Row>
                          </Col>
                        </Row>
                      </Col>
                      <Col span={7} />
                    </Row>
                  </Col>
                  <Col span={24}>
                    <Row>
                      <Col span={17} className={style.about}>
                        <Row>
                          <Col span={24}>
                            <Title level={5}>Về chúng tôi</Title>
                          </Col>
                          <Col span={24} style={{ paddingTop: '24px' }}>
                            <p>
                              Sau hơn 3 thập kỷ nỗ lực hoàn thành mục tiêu phổ cập dịch vụ viễn thông, đưa viễn thông và
                              công nghệ thông tin vào mọi lĩnh vực của cuộc sống ở Việt Nam, Tập đoàn Công nghiệp - Viễn
                              thông Quân đội (Viettel) đặt ra khát vọng trở thành Tập đoàn công nghiệp và công nghệ vươn
                              tầm thế giới. Ở bất cứ giai đoạn nào trên hành trình ấy, lời hứa “sáng tạo vì con người”
                              vẫn còn mãi.
                            </p>
                            <p>
                              Với chủ trương lấy con người làm trọng tâm phát triển, Viettel mang trong mình một trái
                              tim biết quan tâm và lòng trắc ẩn biết thấu hiểu, từ đó tôn vinh bản sắc mỗi cá nhân và
                              thúc đẩy sự gắn kết giữa người với người qua việc lắng nghe từng nhu cầu, mong muốn khác
                              biệt, khích lệ thể hiện bản thân theo cách của riêng mình.
                            </p>
                            <p>
                              Sự sáng tạo có đích đến cụ thể là con người nhằm góp phần kiến tạo một cuộc sống tốt đẹp
                              hơn. Con người là động lực giúp Viettel không ngừng dịch chuyển để tiên phong đón những
                              thay đổi của thời cuộc và sẵn sàng khai phá tiềm năng trong thực tại mới. Tại Viettel, sự
                              sáng tạo đã vượt xa những sản phẩm, dịch vụ hữu hình để trở thành dòng chảy cảm hứng bất
                              tận cho những ý tưởng mới lạ và tư duy đột phá.
                            </p>
                            <p>
                              Ngọn lửa Viettel được thổi bùng từ khao khát – hướng tới kiến tạo một tương lai vươn tầm.
                              Khát khao cống hiến đã và đang tiếp thêm nguồn năng lượng dồi dào, đưa Viettel bứt phá
                              giới hạn, vượt qua thách thức và chinh phục đỉnh cao. Khát khao đối với mỗi người Viettel
                              còn là động lực để nghĩ lớn và là mục tiêu để vươn xa, biến khát khao thành hành động,
                              giúp thực hiện trọng trách quốc gia và đổi mới theo tư duy toàn cầu.
                            </p>
                          </Col>
                          <Col span={24}>
                            <Row style={{ alignItems: 'center' }}>
                              <Col style={{ flex: '1' }}>
                                <div className={style.line} />
                              </Col>
                              <Col style={{ display: 'flex', justifyContent: 'flex-end' }}>
                                <Button icon={<BiArrowToTop />}>Thu gọn</Button>
                              </Col>
                            </Row>
                          </Col>
                        </Row>
                      </Col>
                    </Row>
                  </Col>
                  <Col span={24}>
                    <Row>
                      <Col span={17} className={style.about}>
                        <Row>
                          <Col span={24}>
                            <Title level={5}>Về chúng tôi</Title>
                          </Col>
                          <Col span={24} style={{ paddingTop: '24px' }}>
                            <p>
                              Sau hơn 3 thập kỷ nỗ lực hoàn thành mục tiêu phổ cập dịch vụ viễn thông, đưa viễn thông và
                              công nghệ thông tin vào mọi lĩnh vực của cuộc sống ở Việt Nam, Tập đoàn Công nghiệp - Viễn
                              thông Quân đội (Viettel) đặt ra khát vọng trở thành Tập đoàn công nghiệp và công nghệ vươn
                              tầm thế giới. Ở bất cứ giai đoạn nào trên hành trình ấy, lời hứa “sáng tạo vì con người”
                              vẫn còn mãi.
                            </p>
                            <p>
                              Với chủ trương lấy con người làm trọng tâm phát triển, Viettel mang trong mình một trái
                              tim biết quan tâm và lòng trắc ẩn biết thấu hiểu, từ đó tôn vinh bản sắc mỗi cá nhân và
                              thúc đẩy sự gắn kết giữa người với người qua việc lắng nghe từng nhu cầu, mong muốn khác
                              biệt, khích lệ thể hiện bản thân theo cách của riêng mình.
                            </p>
                            <p>
                              Sự sáng tạo có đích đến cụ thể là con người nhằm góp phần kiến tạo một cuộc sống tốt đẹp
                              hơn. Con người là động lực giúp Viettel không ngừng dịch chuyển để tiên phong đón những
                              thay đổi của thời cuộc và sẵn sàng khai phá tiềm năng trong thực tại mới. Tại Viettel, sự
                              sáng tạo đã vượt xa những sản phẩm, dịch vụ hữu hình để trở thành dòng chảy cảm hứng bất
                              tận cho những ý tưởng mới lạ và tư duy đột phá.
                            </p>
                            <p>
                              Ngọn lửa Viettel được thổi bùng từ khao khát – hướng tới kiến tạo một tương lai vươn tầm.
                              Khát khao cống hiến đã và đang tiếp thêm nguồn năng lượng dồi dào, đưa Viettel bứt phá
                              giới hạn, vượt qua thách thức và chinh phục đỉnh cao. Khát khao đối với mỗi người Viettel
                              còn là động lực để nghĩ lớn và là mục tiêu để vươn xa, biến khát khao thành hành động,
                              giúp thực hiện trọng trách quốc gia và đổi mới theo tư duy toàn cầu.
                            </p>
                          </Col>
                          <Col span={24}>
                            <Row style={{ alignItems: 'center' }}>
                              <Col style={{ flex: '1' }}>
                                <div className={style.line} />
                              </Col>
                              <Col style={{ display: 'flex', justifyContent: 'flex-end' }}>
                                <Button icon={<BiArrowToTop />}>Thu gọn</Button>
                              </Col>
                            </Row>
                          </Col>
                        </Row>
                      </Col>
                    </Row>
                  </Col>
                </Row>
              </Col>
              <Col span={24} className={toggle === 2 ? `${style.none} ${style.tabContent}` : `${style.none}`}>
                {/* <Row>
                  <Col span={24}>
                    <Row>
                      <Col span={17}>
                        <Row>
                          <Col span={24}>
                            <Title level={5}>Giới thiệu</Title>
                          </Col>
                          <Col span={24}>
                            <Row>
                              <Col span={12}>
                                <span>Tên đầy đủ:</span>
                                <Paragraph>Tập đoàn Công nghiệp - Viễn thông Quân đội Viettel</Paragraph>
                              </Col>
                              <Col span={12}>
                                <span>Tên quốc tế:</span>
                                <Paragraph>Viettel Group</Paragraph>
                              </Col>
                            </Row>
                          </Col>
                          <Col span={24}>
                            <Row>
                              <Col span={12}>
                                <span>Mã số thuế:</span>
                                <Paragraph>0100683550-005</Paragraph>
                              </Col>
                              <Col span={12}>
                                <span>Địa chỉ:</span>
                                <Paragraph>
                                  Lô D26 Khu đô thị mới Cầu Giấy, Phường Yên Hòa, Quận Cầu Giấy, Hà Nội, Việt Nam
                                </Paragraph>
                              </Col>
                            </Row>
                          </Col>
                          <Col span={24}>
                            <Row>
                              <Col span={12}>
                                <span>Ngày thành lập:</span>
                                <Paragraph>01/06/1989</Paragraph>
                              </Col>
                              <Col span={12}>
                                <span>Quy mô nhân sự:</span>
                                <Paragraph>50.000+ nhân viên</Paragraph>
                              </Col>
                            </Row>
                          </Col>
                        </Row>
                      </Col>
                      <Col span={7} />
                    </Row>
                  </Col>
                </Row> */}
                1
              </Col>
            </Row>
          </div>
        </div>
      </div>
    </div>
  );
}

export default CompanyDetail;
