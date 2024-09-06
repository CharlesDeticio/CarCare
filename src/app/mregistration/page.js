import React from 'react';
import { Container, Typography, TextField, Button, Box, Grid, Link } from '@mui/material';

const CustomerRegister = () => {
  return (
    <>
      <Box>
        
          <Box sx={{ 
                 
                minHeight: '100vh', 
                padding: 3, 
                display: 'flex', 
                justifyContent: 'center', 
                alignItems: 'center'}}>
            <Container>
              <Grid container spacing={2} justifyContent="center">
                <Grid item xs={12} sm={6}>
                  <Box
                    component="form"
                    sx={{
                      width: '100%',
                      padding: 4,
                      backgroundColor: '#fff',
                      borderRadius: 2,
                      boxShadow: 3,
                      justifyContent: "center",
                      
                    }}
                  >
                    <Typography variant="h5" justifyContent="center" sx={{fontFamily: 'Inter, sans-serif', paddingBottom: 2}} gutterBottom>
                      Mechanic Shop Registration
                    </Typography>

                    <TextField
                      label="Shop Name"
                      variant="outlined"
                      type="shopname"
                      fullWidth
                      sx={{ marginBottom: 2 }}
                    />
                    <TextField
                      label="Email"
                      variant="outlined"
                      type="email"
                      fullWidth
                      sx={{ marginBottom: 2 }}
                    />
                    <TextField
                      label="Username"
                      variant="outlined"
                      type="username"
                      fullWidth
                      sx={{ marginBottom: 2 }}
                    />
                    <TextField
                      label="Password"
                      variant="outlined"
                      type="password"
                      fullWidth
                      sx={{ marginBottom: 2 }}
                    />
                    <TextField
                      label="Confirm Password"
                      variant="outlined"
                      type="password"
                      fullWidth
                      sx={{ marginBottom: 2 }}
                    />

                    <Button variant="contained" type="submit" sx={{ backgroundColor: '#1141c1', '&:hover': { backgroundColor: '#0d2a7c' } }}fullWidth >
                      Register as Mechanic
                    </Button>
                    <Grid container justifyContent="flex-end">
                      <Grid item sx={{padding: 2}}>
                        <Link href="/login" variant="body2" >
                          Already have an account? Sign in
                        </Link>
                      </Grid>
                    </Grid>
                  </Box>
                </Grid>
              </Grid>
            </Container>
          </Box>
      </Box>
    </>
  );
};

export default CustomerRegister;