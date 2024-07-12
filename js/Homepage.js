document.addEventListener('DOMContentLoaded', (event) => {
    const uploadButton = document.getElementById('imageUpload');
    const imagePreview = document.getElementById('imagePreview');

    uploadButton.addEventListener('change', () => {
        const file = uploadButton.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});

function populateGameRanks() {
    var gameSelect = document.getElementById("game");
    var rankSelect = document.getElementById("gameRank");
    var selectedGame = gameSelect.value;

    rankSelect.innerHTML = '<option disabled selected value="">Select Game Rank</option>';

    switch (selectedGame) {
        case "League of Legends":
            addOption(rankSelect, "Gold");
            addOption(rankSelect, "Platinum");
            addOption(rankSelect, "Diamond");
            addOption(rankSelect, "Master");
            addOption(rankSelect, "GrandMaster");
            addOption(rankSelect, "Challenger");
            break;
        case "Rocket League":
            addOption(rankSelect, "Platinum");
            addOption(rankSelect, "Diamond");
            addOption(rankSelect, "Champion");
            addOption(rankSelect, "Grand Champion");
            addOption(rankSelect, "Supersonic Legend");
            break;
        case "Fortnite":
            addOption(rankSelect, "Platinum");
            addOption(rankSelect, "Diamond");
            addOption(rankSelect, "Elite");
            addOption(rankSelect, "Champion");
            addOption(rankSelect, "Unreal");
            break;      
        case "Valorant":
            addOption(rankSelect, "Gold");
            addOption(rankSelect, "Platinum");
            addOption(rankSelect, "Diamond");
            addOption(rankSelect, "Ascendant");
            addOption(rankSelect, "Immortal");
            addOption(rankSelect, "Radiant");
            break;
        case "Counter Strike 2":
            addOption(rankSelect, "Gold Nova");
            addOption(rankSelect, "Master Guardian");
            addOption(rankSelect, "Legendary Eagle");
            addOption(rankSelect, "Supreme Master First Class");
            addOption(rankSelect, "The Global Elite");
            break;
        case "Dota 2":
            addOption(rankSelect, "Archon");
            addOption(rankSelect, "Legend");
            addOption(rankSelect, "Ancient");
            addOption(rankSelect, "Divine");
            break;
        case "Chess":
            addOption(rankSelect, "Expert/National Candidate Master");
            addOption(rankSelect, "FIDE Candidate Master/National Master");
            addOption(rankSelect, "FIDE Master");
            addOption(rankSelect, "International Masters");
            addOption(rankSelect, "Grandmasters");
            break;
        case "Tom Clancy''s Rainbow Six Siege":
            addOption(rankSelect, "Gold");
            addOption(rankSelect, "Platinum");
            addOption(rankSelect, "Emerald");
            addOption(rankSelect, "Diamond");
            addOption(rankSelect, "Champion");
            break;
        case "Overwatch 2":
            addOption(rankSelect, "Platinum");
            addOption(rankSelect, "Diamond");
            addOption(rankSelect, "Master");
            addOption(rankSelect, "Grandmaster");
            addOption(rankSelect, "Champion");
            addOption(rankSelect, "Top 500");
            break;
        case "Tekken 8":
            addOption(rankSelect, "Garyu");
            addOption(rankSelect, "Shinryu");
            addOption(rankSelect, "Tenryu");
            addOption(rankSelect, "Mighty Ruler");
            addOption(rankSelect, "Flame Ruler");
            addOption(rankSelect, "Battle Ruler");
            addOption(rankSelect, "Fujin");
            addOption(rankSelect, "Raijin");
            addOption(rankSelect, "Kishin");
            addOption(rankSelect, "Bushin");
            addOption(rankSelect, "Tekken Emperor");
            addOption(rankSelect, "Tekken God");
            addOption(rankSelect, "Tekken God Supreme");
            addOption(rankSelect, "God of Destruction");
            break;
    }
}

function addOption(selectElement, optionText) {
    var option = document.createElement("option");
    option.textContent = optionText;
    option.value = optionText;
    selectElement.appendChild(option);
}