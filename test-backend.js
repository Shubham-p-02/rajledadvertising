const fetch = require('node-fetch');

// Test the health endpoint
async function testHealth() {
  try {
    const response = await fetch('http://localhost:3000/api/health');
    const data = await response.json();
    console.log('✅ Health check passed:', data);
  } catch (error) {
    console.log('❌ Health check failed:', error.message);
  }
}

// Test the contact endpoint (without email sending)
async function testContact() {
  try {
    const testData = {
      name: 'Test User',
      email: 'test@example.com',
      subject: 'Test Message',
      message: 'This is a test message from the backend test script.'
    };

    const response = await fetch('http://localhost:3000/api/contact', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(testData)
    });

    const data = await response.json();
    
    if (response.ok) {
      console.log('✅ Contact endpoint test passed:', data);
    } else {
      console.log('❌ Contact endpoint test failed:', data);
    }
  } catch (error) {
    console.log('❌ Contact endpoint test failed:', error.message);
  }
}

// Run tests
async function runTests() {
  console.log('🧪 Testing Raj Advertising Backend...\n');
  
  await testHealth();
  console.log('');
  
  await testContact();
  console.log('\n✨ Tests completed!');
}

// Only run if this file is executed directly
if (require.main === module) {
  runTests();
}

module.exports = { testHealth, testContact }; 