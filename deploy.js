const Web3 = require('web3');
const fs = require('fs');
const solc = require('solc');

// Create a web3 instance using Infura provider
const providerUrl = 'https://mainnet.infura.io/v3/e0468e3142cd45c38fd9c895c70070b5';
const web3 = new Web3(providerUrl);

// Read the Solidity contract file
const contractFilePath = 'new\contract\contracts\NFTMerketplace.sol';
const contractContent = fs.readFileSync(contractFilePath, 'utf8');

// Compile the contract
const input = {
  language: 'Solidity',
  sources: {
    'MyContract.sol': {
      content: contractContent,
    },
  },
  settings: {
    outputSelection: {
      '*': {
        '*': ['*'],
      },
    },
  },
};

const compiledContract = JSON.parse(solc.compile(JSON.stringify(input)));
const contractBytecode = compiledContract.contracts['MyContract.sol']['MyContract'].evm.bytecode.object;
const contractAbi = compiledContract.contracts['MyContract.sol']['MyContract'].abi;

// Deploy the contract
const deploy = async () => {
  const accounts = await web3.eth.getAccounts();
  const deployAccount = accounts[0];

  const contract = new web3.eth.Contract(contractAbi);

  const deployTransaction = contract.deploy({
    data: contractBytecode,
    arguments: [arg1, arg2], // If your contract constructor requires arguments
  });

  const deployOptions = {
    from: deployAccount,
    gas: 4000000, // Adjust the gas limit according to your contract
  };

  try {
    const deployedContract = await deployTransaction.send(deployOptions);
    console.log('Contract deployed. Address:', deployedContract.options.address);
  } catch (error) {
    console.error('Error deploying contract:', error);
  }
};

deploy();
