import React from 'react';
import { Container, Typography, Box, Grid, Card, CardContent, IconButton } from '@mui/material';
import CarRepairIcon from '@mui/icons-material/CarRepair';
import BuildIcon from '@mui/icons-material/Build';
import CalendarTodayIcon from '@mui/icons-material/CalendarToday';

const AboutPage = () => {
  return (
    <Box sx={{ backgroundColor: '#f5f5f5', minHeight: '100vh', paddingTop: 3 }}>
      {/* Hero Section */}
      <Box
        sx={{
          backgroundColor: '#1141c1',
          color: 'white',
          padding: '80px 0',
          textAlign: 'center',
        }}
      >
        <Container>
          <Typography variant="h2" gutterBottom>
            About CarCare
          </Typography>
          <Typography variant="h5" paragraph>
            Learn more about who we are and what drives us to deliver the best car maintenance experience.
          </Typography>
        </Container>
      </Box>

      {/* Company Mission Section */}
      <Container sx={{ padding: '40px 0' }}>
        <Typography variant="h4" gutterBottom align="center">
          Our Mission
        </Typography>
        <Typography variant="body1" align="center" paragraph>
          At CarCare, we believe in providing quality, convenience, and transparency when it comes to your car repair
          needs. Our mission is to ensure every vehicle gets back on the road safely and efficiently. With skilled
          mechanics and an easy booking process, we aim to revolutionize the car maintenance industry.
        </Typography>
      </Container>

      {/* What We Offer Section */}
      <Container sx={{ padding: '40px 0' }}>
        <Typography variant="h4" gutterBottom align="center">
          What We Offer
        </Typography>
        <Grid container spacing={4} justifyContent="center">
          <Grid item xs={12} sm={6} md={4}>
            <Card sx={{ height: '100%', boxShadow: 3 }}>
              <CardContent sx={{ display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                <IconButton color="primary" sx={{ fontSize: 60 }}>
                  <CarRepairIcon />
                </IconButton>
                <Typography variant="h6" gutterBottom>
                  Professional Mechanics
                </Typography>
                <Typography variant="body1" align="center">
                  Our highly trained network of professional mechanics ensures that your car receives expert care every
                  time.
                </Typography>
              </CardContent>
            </Card>
          </Grid>

          <Grid item xs={12} sm={6} md={4}>
            <Card sx={{ height: '100%', boxShadow: 3 }}>
              <CardContent sx={{ display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                <IconButton color="primary" sx={{ fontSize: 60 }}>
                  <BuildIcon />
                </IconButton>
                <Typography variant="h6" gutterBottom>
                  Quality Parts
                </Typography>
                <Typography variant="body1" align="center">
                  We use only high-quality parts that ensure your vehicle runs smoothly and reliably.
                </Typography>
              </CardContent>
            </Card>
          </Grid>

          <Grid item xs={12} sm={6} md={4}>
            <Card sx={{ height: '100%', boxShadow: 3 }}>
              <CardContent sx={{ display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                <IconButton color="primary" sx={{ fontSize: 60 }}>
                  <CalendarTodayIcon />
                </IconButton>
                <Typography variant="h6" gutterBottom>
                  Easy Scheduling
                </Typography>
                <Typography variant="body1" align="center">
                  With our easy-to-use platform, you can schedule services at a time that works for you.
                </Typography>
              </CardContent>
            </Card>
          </Grid>
        </Grid>
      </Container>

      {/* Footer */}
      <Box sx={{ backgroundColor: '#1141c1', color: 'white', padding: '20px 0' }}>
        <Container>
          <Typography variant="body1" align="center">
            © 2024 CarCare. All rights reserved.
          </Typography>
        </Container>
      </Box>
    </Box>
  );
};

export default AboutPage;
