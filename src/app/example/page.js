'use client';

import React, { useState } from 'react';
import { 
  Container, 
  Card, 
  CardContent, 
  Typography, 
  Grid, 
  Button, 
  TextField, 
  IconButton, 
  Box, 
  AppBar, 
  Toolbar, 
  Divider,
  Avatar
} from '@mui/material';
import DeleteIcon from '@mui/icons-material/Delete';

// Dummy data
const cartItems = [
  { id: 1, name: 'Belt', price: 50, image: '/img/belt1.jpg', shop: "Nelson's Automotive Shop" },
  { id: 2, name: 'Oil Filter', price: 15, image: '/img/oilfilter.jpg', shop: "Nelson's Automotive Shop" }
];

function ShoppingCart() {
  const [cart, setCart] = useState(cartItems);

  const handleQuantityChange = (id, value) => {
    const updatedCart = cart.map(item =>
      item.id === id ? { ...item, quantity: value } : item
    );
    setCart(updatedCart);
  };

  const handleRemoveItem = (id) => {
    setCart(cart.filter(item => item.id !== id));
  };

  const handlePlaceOrder = () => {
    console.log('Order placed');
  };

  const handleCancelPurchase = () => {
    setCart([]);
  };

  const styles = {
    appBar: {
      backgroundColor: 'light blue',
      borderRadius: '0 0 20px 20px',
      boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)',
    },
    toolbar: {
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'space-between',
    },
    logo: {
      height: '40px',
      borderRadius: '50%',
    },
    card: {
      height: '100%',
      display: 'flex',
      flexDirection: 'column',
      borderRadius: '15px',
      boxShadow: '0 4px 8px rgba(0, 0, 0, 0.1)',
    },
    cardContent: {
      flexGrow: 1,
      padding: 2,
    },
    cardMedia: {
      height: '200px',
      borderTopLeftRadius: '15px',
      borderTopRightRadius: '15px',
    },
    button: {
      margin: 2,
    },
    container: {
      paddingTop: 4,
      paddingBottom: 4,
    },
    paper: {
      padding: 2,
      margin: 'auto',
      maxWidth: '100%',
      borderRadius: '10px',
      boxShadow: '0 4px 8px rgba(0, 0, 0, 0.1)',
    },
    footer: {
      marginTop: 4,
      padding: 2,
      backgroundColor: '#f5f5f5',
    },
    imageMapContainer: {
      position: 'relative',
      width: '100%',
      height: 'auto',
    },
    imageMap: {
      width: '100%',
      height: 'auto',
      maxWidth: '1200px', 
    },
  };

  return (
    <Box sx={{
      backgroundColor: '#f0f0f0', 
      minHeight: '100vh', 
    }}>
      <AppBar position="static" sx={styles.appBar}>
  <Toolbar>
    <IconButton
      size="large"
      edge="start"
      color="inherit"
      aria-label="menu"
      sx={{ mr: 2 }}
    >
    </IconButton>
    <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
      Carcare
    </Typography>
    <Button
      color="inherit"
      sx={{
        '&:hover': {
          backgroundColor: 'black', 
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
          backgroundColor: 'black', 
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
          backgroundColor: 'black', 
          color: '#fff',
        },
      }}
    >
      Cart
    </Button>
    
    <TextField
      sx={{
        ...styles.search,
        width: '200px', // Adjust the width as needed
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
          color: 'Black',
        },
        '& .MuiInputBase-input': {
          color: 'black',
          fontSize: '0.750rem', 
          marginBottom: '4px'
        },
      }}
      label="Search"
      variant="outlined"
      size="small"
      placeholder="Search here..."
    />
    <Avatar src="profile.png" sx={{ ml: 1 }} />
    <Button
      color="inherit"
      sx={{
        '&:hover': {
          backgroundColor: 'black rgba(0, 0, 0, 0.5)', 
          color: '#fff',
        },
      }}
    >
      Logout
    </Button>
  </Toolbar>
</AppBar>

      <Container sx={{ mt: 5 }}>
        <Typography variant="h4" component="div" sx={{ mb: 4 }}>
          Shopping Cart
        </Typography>
        <Divider sx={{ mb: 4 }}/>

        {cart.map(item => (
          <Card key={item.id} sx={{
            mb: 2,
            borderRadius: '15px',
            boxShadow: '0 6px 12px rgba(0, 0, 0, 0.1)',
            transition: 'transform 0.3s',
            '&:hover': { transform: 'scale(1.02)' },
          }}>
            <CardContent>
              <Grid container spacing={2} alignItems="center">
                <Grid item xs={2}>
                  <img src={item.image} alt={item.name} width="80" style={{ borderRadius: '8px' }} />
                </Grid>
                <Grid item xs={5}>
                  <Typography variant="h6">{item.name}</Typography>
                  <Typography variant="body2" color="textSecondary">{item.shop}</Typography>
                </Grid>
                <Grid item xs={2}>
                  <Typography variant="body1" color="primary">${item.price.toFixed(2)}</Typography>
                </Grid>
                <Grid item xs={2}>
                  <TextField
                    type="number"
                    defaultValue={1}
                    onChange={(e) => handleQuantityChange(item.id, e.target.value)}
                    size="small"
                    sx={{ width: '100px' }}
                  />
                </Grid>
                <Grid item xs={1}>
                  <IconButton onClick={() => handleRemoveItem(item.id)}>
                    <DeleteIcon color="error" />
                  </IconButton>
                </Grid>
              </Grid>
            </CardContent>
          </Card>
        ))}

        <Grid container justifyContent="flex-end" spacing={2}>
          <Grid item>
            <Button variant="contained" color="primary" onClick={handlePlaceOrder} sx={{ marginRight: 2 }}>
              Place Order(s)
            </Button>
          </Grid>
          <Grid item>
            <Button variant="outlined" color="error" onClick={handleCancelPurchase}>
              Clear Cart
            </Button>
          </Grid>
        </Grid>
      </Container>
    </Box>
  );
};

export default ShoppingCart;