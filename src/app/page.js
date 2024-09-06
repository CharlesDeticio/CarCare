import React from 'react';
import { Container, Typography, Box, Button, Grid, Card, CardContent, CardMedia, IconButton } from '@mui/material';
import CarRepairIcon from '@mui/icons-material/CarRepair';
import BuildIcon from '@mui/icons-material/Build';
import CalendarTodayIcon from '@mui/icons-material/CalendarToday';
import Link from 'next/link';

const LandingPage = () => {
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
            Welcome to CarCare
          </Typography>
          <Typography variant="h5" paragraph>
            Your one-stop solution for all your car repair and maintenance needs. Book your service online and get back on the road in no time.
          </Typography>
          <Button variant="contained" color="primary" size="large" href="/login">
            Book a Service
          </Button>
        </Container>
      </Box>

      {/* Features Section */}
      <Container sx={{ padding: '40px 0' }}>
        <Typography variant="h4" gutterBottom align="center">
          We Offer
        </Typography>
        <Grid container spacing={4} justifyContent="center">
          <Grid item xs={12} sm={6} md={4}>
            <Card sx={{ height: '100%', boxShadow: 3 }}>
              <CardContent sx={{ display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                <IconButton color="primary" sx={{ fontSize: 60 }}>
                  <CarRepairIcon />
                </IconButton>
                <Typography variant="h6" gutterBottom>
                  Expert Mechanics
                </Typography>
                <Typography variant="body1" align="center">
                  Our network of skilled mechanic shops provides top-notch repair services for all car models.
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
                  Convenient Booking
                </Typography>
                <Typography variant="body1" align="center">
                  Schedule your car repair service online at your convenience with our easy-to-use platform.
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
                  Flexible Scheduling
                </Typography>
                <Typography variant="body1" align="center">
                  Choose a time that works best for you and get reminders for your appointment.
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
            © 2024 <Link href="/about">CarCare</Link> All rights reserved.
          </Typography>
        </Container>
      </Box>
    </Box>
  );
};

export default LandingPage;
