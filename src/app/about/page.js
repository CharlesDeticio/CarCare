import React from 'react';
import { Container, Typography, Box, AppBar, Toolbar, Button, TextField, Avatar} from '@mui/material';
import { deepOrange } from '@mui/material/colors';

const styles = {
  appBar: {
    backgroundColor: '#1141c1',
    borderRadius: '20px 20px 20px 20px',
    boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)',
  }
};

<AppBar position="static" sx={styles.appBar}>
        <Toolbar>
          <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
            Welcome Back, User!
          </Typography>
          <Button
            color="inherit"
            sx={{
              '&:hover': {
                backgroundColor: '#2956de', 
                color: '#fff',
              },
            }}
          >
            Home
          </Button>
          <Button
            color="inherit"
            sx={{
              '&:hover': {
                backgroundColor: '#2956de', 
                color: '#fff',
              },
            }}
          >
            Booking
          </Button>
          <Button
            color="inherit"
            sx={{
              '&:hover': {
                backgroundColor: '#2956de', 
                color: '#fff',
              },
            }}
          >
            Cart
          </Button>
          
          <TextField
            sx={{
              ...styles.search,
              width: '200px',
              '& .MuiOutlinedInput-root': {
                '& fieldset': {
                  borderColor: 'white',
                },
                '&:hover fieldset': {
                  borderColor: 'white',
                },
                '&.Mui-focused fieldset': {
                  borderColor: 'white',
                },
              },
              '& .MuiInputLabel-root': {
                color: 'white',
              },
              '& .MuiInputBase-input': {
                color: 'black',
                fontSize: '0.7rem',
              },
            paddingRight: 2}}
            label="Search"
            variant="outlined"
            size="small"
            placeholder="Search here..."
          />
      
        <Avatar sx={{ bgcolor: deepOrange[500] }}>N</Avatar>
        
          <Button
            color="inherit"
            sx={{
              '&:hover': {
                backgroundColor: '#2956de', 
                color: '#fff',
              },
            }}
            href = "/login"
          >
            Logout
          </Button>
        </Toolbar>
      </AppBar>


const AboutPage = () => {
  return (
    <Container sx={{ minHeight: '100vh', padding: 4 }}>
      <Typography variant="h3" align="center" gutterBottom>
        About CarCare
      </Typography>

      <Typography variant="h5" gutterBottom>
        What We Do
      </Typography>
      <Typography variant="body1" paragraph>
        Our platform allows you to book appointments with qualified mechanics for a wide range of services. Whether you need a quick oil change, a thorough inspection, or major repairs, CarCare has you covered. Our network of skilled professionals is dedicated to providing high-quality service and ensuring your car is in top condition.
      </Typography>


      <Box sx={{ marginTop: 4 }}>
        <Typography variant="h5" gutterBottom>
          Contact Us
        </Typography>
        <Typography variant="body1">
          Have questions or need support? Reach out to us at <a href="">support@carcare.com</a>. We're here to help!
        </Typography>
      </Box>
    </Container>
  );
};

export default AboutPage;
