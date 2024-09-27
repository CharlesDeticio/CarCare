import React from 'react';
import { Box, Container, Typography, Grid, Button, Card, CardContent, CardMedia } from '@mui/material';

const carRepairTheme = {
  palette: {
    primary: {
      main: '#1141c1',
    },
    secondary: {
      main: '#FF6B35',
    },
    background: {
      default: '#f5f5f5',
      paper: '#ffffff',
    },
    text: {
      primary: '#333',
      secondary: '#555',
    },
  },
  typography: {
    fontFamily: 'Poppins, sans-serif',
    h1: {
      fontWeight: 'bold',
      textTransform: 'uppercase',
      color: '#1141c1',
    },
    h5: {
      fontWeight: 400,
    },
    body1: {
      color: '#555',
    },
  },
  components: {
    MuiButton: {
      styleOverrides: {
        root: {
          borderRadius: 8,
          textTransform: 'none',
          boxShadow: '0px 3px 6px rgba(0, 0, 0, 0.16)',
          padding: '10px 20px',
          '&:hover': {
            backgroundColor: '#FF6B35',
            boxShadow: '0px 4px 8px rgba(0, 0, 0, 0.2)',
          },
        },
      },
    },
    MuiCard: {
      styleOverrides: {
        root: {
          borderRadius: 12,
          boxShadow: '0px 5px 15px rgba(0, 0, 0, 0.2)',
        },
      },
    },
  },
};

const CarRepairLandingPage = () => {
  return (
    <Box sx={{ backgroundColor: '#f5f5f5', minHeight: '100vh', paddingTop: 4 }}>
      <Box
        sx={{
          backgroundColor: '#1141c1',
          color: 'white',
          padding: '100px 0',
          textAlign: 'center',
          clipPath: 'polygon(0 0, 100% 0, 100% 85%, 0 100%)',
        }}
      >
        <Container>
          <Typography variant="h1" gutterBottom>
            Professional Car Care Services
          </Typography>
          <Typography variant="h5" paragraph>
            From routine maintenance to advanced repairs, we've got you covered.
          </Typography>
          <Button variant="contained" color="secondary" size="large" sx={{ mt: 3 }}>
            Book a Service
          </Button>
        </Container>
      </Box>

      <Container sx={{ padding: '60px 0' }}>
        <Typography variant="h4" align="center" gutterBottom sx={{ fontWeight: 'bold', color: '#333' }}>
          Our Services
        </Typography>
        <Grid container spacing={4} sx={{ marginTop: 4 }}>
          <Grid item xs={12} sm={6} md={4}>
            <Card>
              <CardMedia
                component="img"
                height="160"
                image="/assets/carrepair.jpg"
                alt="Car Repair"
              />
              <CardContent>
                <Typography variant="h6" gutterBottom>
                  Engine Repair
                </Typography>
                <Typography variant="body1">
                  Expert engine diagnostics and repair services to get your car running like new.
                </Typography>
              </CardContent>
            </Card>
          </Grid>
          <Grid item xs={12} sm={6} md={4}>
            <Card>
              <CardMedia
                component="img"
                height="160"
                image="/assets/tireservice.jpg"
                alt="Tire Service"
              />
              <CardContent>
                <Typography variant="h6" gutterBottom>
                  Tire Service
                </Typography>
                <Typography variant="body1">
                  Comprehensive tire maintenance, replacement, and alignment for safety and performance.
                </Typography>
              </CardContent>
            </Card>
          </Grid>
          <Grid item xs={12} sm={6} md={4}>
            <Card>
              <CardMedia
                component="img"
                height="160"
                image="/assets/oilchange.jpg"
                alt="Oil Change"
              />
              <CardContent>
                <Typography variant="h6" gutterBottom>
                  Oil Change
                </Typography>
                <Typography variant="body1">
                  Regular oil changes to keep your engine running smoothly and efficiently.
                </Typography>
              </CardContent>
            </Card>
          </Grid>
        </Grid>
      </Container>

      <Box
        sx={{
          backgroundColor: '#FF6B35',
          color: 'white',
          padding: '60px 0',
          textAlign: 'center',
        }}
      >
        <Container>
          <Typography variant="h4" gutterBottom sx={{ fontWeight: 'bold' }}>
            Get a Free Quote Today
          </Typography>
          <Typography variant="h6" paragraph>
            Contact us now to learn more about our services and get a personalized estimate.
          </Typography>
          <Button variant="contained" color="primary" size="large">
            Contact Us
          </Button>
        </Container>
      </Box>
    </Box>
  );
};

export default CarRepairLandingPage;
