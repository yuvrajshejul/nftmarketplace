document.getElementById("connectWalletBtn").addEventListener("click", connectWallet);

function connectWallet() {
    if (window.ethereum) {
        // Requesting access to the user's MetaMask wallet
        ethereum
            .request({ method: "eth_requestAccounts" })
            .then((accounts) => {
                // Connection successful, accounts[0] contains the connected wallet address
                const walletAddress = accounts[0];
                // Perform any additional actions with the wallet address
                console.log("Connected to wallet:", walletAddress);
            })
            .catch((error) => {
                // Connection failed or user denied access
                console.log(error);
            });
    } else {
        // User does not have MetaMask installed or it's not supported
        console.log("Please install MetaMask to connect your wallet.");
    }
}
